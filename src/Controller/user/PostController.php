<?php

namespace App\Controller\user;

use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\service\BotProtectionService;
use App\service\ContentModerationService;
use App\service\ModerationRecordService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\service\ImageEnhancerService;
class PostController extends AbstractController
{
    private ImageEnhancerService $imageEnhancer;

    public function __construct(ImageEnhancerService $imageEnhancer)
    {
        $this->imageEnhancer = $imageEnhancer;
    }
    // ── CREATE ──────────────────────────────────────────────────────────
    #[Route('/post/create', name: 'post_create')]
    public function create(
        Request $request,
        EntityManagerInterface $em,
        SluggerInterface $slugger,
        BotProtectionService $botProtectionService,
        ContentModerationService $contentModerationService,
        ModerationRecordService $moderationRecordService
    ): Response {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $botIssue = $botProtectionService->validateRequest($request, 'post_create');
            if ($botIssue !== null) {
                $this->addFlash('error', $botIssue);
                return $this->redirectToRoute('post_create');
            }

            $moderationResult = $contentModerationService->evaluateContent(
                [
                    $post->getTitle(),
                    $post->getBody(),
                    $post->getType(),
                ],
                'post',
                $request,
                $user
            );
            $moderationIssue = $moderationResult['issue_message'] ?? null;
            if ($moderationIssue !== null) {
                $this->addFlash('error', $moderationIssue);
                return $this->redirectToRoute('post_create');
            }

            // ── Handle uploaded images ──────────────────────────────────
            $imageUrls = [];
            $files = $form->get('imageFile')->getData(); // array (multiple: true)

            if ($files) {
                $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/posts';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0775, true);
                }

                foreach ($files as $file) {
                    if (!$file)
                        continue;

                    // Process image: enhance + remove background
                    $results = $this->imageEnhancer->processImage($file, $uploadDir);

                    // Store the enhanced version (or original if enhancement failed)
                    $imageUrls[] = $results['enhanced'] ?? $results['original'];

                    // Optional: log or handle $results['no_background'] if needed
                }
            }

            // Store first image URL in the existing image_url column,
            // join multiple as comma-separated for now (or just use the first one)
            if (!empty($imageUrls)) {
                $post->setImageUrl(implode(',', $imageUrls));
            }

            $post->setUserId($user->getId());
            $post->setTripId(null);
            $post->setCreatedAt(new \DateTime());
            $post->setUpdatedAt(new \DateTime());
            $post->setIsConfirmed(false); // pending admin approval

            $em->persist($post);
            $em->flush();

            $postId = $post->getId();
            if ($postId !== null) {
                $moderationRecordService->upsert('post', (int) $postId, $moderationResult, 'api');
            }

            $this->addFlash('success', 'Your post has been submitted and is pending approval.');
            return $this->redirectToRoute('blog');
        }

        return $this->render('front/blog/create_post.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // ── SHOW ─────────────────────────────────────────────────────────────
    #[Route('/post/{id}', name: 'post_show', requirements: ['id' => '\d+'])]
    public function show(int $id, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            throw $this->createNotFoundException('Post not found.');
        }
        if ($post->isRemovedByAdmin()) {
            throw $this->createNotFoundException('Post not found.');
        }

        // Build author map for post + comments
        $authorIds = array_unique(array_filter(array_merge(
            [$post->getUserId()],
            array_map(fn($c) => $c->getUserId(), $post->getComments()->toArray())
        )));
        $authors = [];
        foreach ($authorIds as $uid) {
            $u = $em->getRepository(User::class)->find($uid);
            if ($u) {
                $authors[$uid] = trim($u->getFirstName() . ' ' . $u->getLastName()) ?: 'User #' . $uid;
            }
        }

        // Reaction summary
        $reactions = $em->getRepository(\App\Entity\Reaction::class)->findBy(['post_id' => $post->getId()]);
        $reactionMap = ['like' => 0, 'love' => 0, 'haha' => 0, 'wow' => 0, 'sad' => 0, 'angry' => 0];
        $userReaction = null;
        /** @var User|null $me */
        $me = $this->getUser();
        $myId = ($me instanceof User) ? $me->getId() : null;
        foreach ($reactions as $r) {
            $t = strtolower(trim((string) $r->getType()));
            if (isset($reactionMap[$t]))
                $reactionMap[$t]++;
            if ($myId && (int) $r->getUserId() === $myId)
                $userReaction = $t;
        }

        return $this->render('front/blog/show.html.twig', [
            'post' => $post,
            'authors' => $authors,
            'reactionMap' => $reactionMap,
            'userReaction' => $userReaction,
        ]);
    }

    // ── EDIT ─────────────────────────────────────────────────────────────
    #[Route('/post/{id}/edit', name: 'post_edit', requirements: ['id' => '\d+'])]
    public function edit(
        int $id,
        Request $request,
        EntityManagerInterface $em,
        SluggerInterface $slugger,
        ContentModerationService $contentModerationService,
        ModerationRecordService $moderationRecordService
    ): Response {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        $post = $em->getRepository(Post::class)->find($id);
        if (!$post)
            throw $this->createNotFoundException('Post not found.');
        if ($post->isRemovedByAdmin())
            throw $this->createNotFoundException('Post not found.');
        if ($post->getUserId() !== $user->getId())
            throw $this->createAccessDeniedException();

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $moderationResult = $contentModerationService->evaluateContent(
                [
                    $post->getTitle(),
                    $post->getBody(),
                    $post->getType(),
                ],
                'post_edit',
                $request,
                $user
            );
            $moderationIssue = $moderationResult['issue_message'] ?? null;
            if ($moderationIssue !== null) {
                $this->addFlash('error', $moderationIssue);
                return $this->redirectToRoute('post_edit', ['id' => $id]);
            }

            $files = $form->get('imageFile')->getData();
            if ($files) {
                $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/posts';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0775, true);
                }

                $imageUrls = [];
                foreach ($files as $file) {
                    if (!$file)
                        continue;

                    $results = $this->imageEnhancer->processImage($file, $uploadDir);
                    $imageUrls[] = $results['enhanced'] ?? $results['original'];
                }
                if (!empty($imageUrls)) {
                    $post->setImageUrl(implode(',', $imageUrls));
                }
            }

            $post->setUpdatedAt(new \DateTime());
            $post->setIsConfirmed(false); // re-approve after edit
            $em->flush();

            $postId = $post->getId();
            if ($postId !== null) {
                $moderationRecordService->upsert('post', (int) $postId, $moderationResult, 'api');
            }

            $this->addFlash('success', 'Post updated and re-submitted for approval.');
            return $this->redirectToRoute('blog');
        }

        return $this->render('front/blog/edit_post.html.twig', [
            'form' => $form->createView(),
            'post' => $post,
        ]);
    }

    // ── DELETE ───────────────────────────────────────────────────────────
    #[Route('/post/{id}/delete', name: 'post_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(int $id, Request $request, EntityManagerInterface $em): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        $post = $em->getRepository(Post::class)->find($id);
        if (!$post)
            throw $this->createNotFoundException('Post not found.');
        if ($post->isRemovedByAdmin())
            throw $this->createNotFoundException('Post not found.');
        if ($post->getUserId() !== $user->getId())
            throw $this->createAccessDeniedException();

        if ($this->isCsrfTokenValid('delete_post_' . $id, $request->request->get('_token'))) {
            $em->remove($post);
            $em->flush();
            $this->addFlash('success', 'Post deleted.');
        }

        return $this->redirectToRoute('blog');
    }

    #[Route('/post/{id}/dismiss-removed', name: 'post_dismiss_removed', methods: ['POST'], requirements: ['id' => '\\d+'])]
    public function dismissRemoved(int $id, Request $request, EntityManagerInterface $em): JsonResponse
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->json(['ok' => false, 'message' => 'Authentication required.'], 401);
        }

        $post = $em->getRepository(Post::class)->find($id);
        if (!$post instanceof Post) {
            return $this->json(['ok' => false, 'message' => 'Post not found.'], 404);
        }

        if (!$post->isRemovedByAdmin()) {
            return $this->json(['ok' => false, 'message' => 'Post is not moderated.'], 422);
        }

        if ((int) $post->getUserId() !== (int) $user->getId()) {
            return $this->json(['ok' => false, 'message' => 'Not allowed.'], 403);
        }

        if (!$this->isCsrfTokenValid('dismiss_removed_post_' . $id, (string) $request->request->get('_token'))) {
            return $this->json(['ok' => false, 'message' => 'Invalid token.'], 400);
        }

        $em->remove($post);
        $em->flush();

        return $this->json(['ok' => true, 'id' => $id]);
    }

    /**
     * AJAX endpoint for the Magic Enhancer Tool
     */
    #[Route('/post/ajax/enhance', name: 'post_ajax_enhance', methods: ['POST'])]
    public function ajaxEnhance(Request $request): JsonResponse
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['ok' => false, 'error' => 'Auth required'], 401);
        }

        $file = $request->files->get('image');
        $action = $request->request->get('action', 'enhance'); // enhance | remove-bg | both

        if (!$file) {
            return $this->json(['ok' => false, 'error' => 'No image uploaded'], 400);
        }

        $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/posts';
        $enhancedDir = $this->getParameter('kernel.project_dir') . '/public/uploads/enhanced';
        if (!is_dir($uploadDir))
            mkdir($uploadDir, 0775, true);
        if (!is_dir($enhancedDir))
            mkdir($enhancedDir, 0775, true);

        $resultUrl = null;

        if ($action === 'remove-bg') {
            $resultUrl = $this->imageEnhancer->removeBackground($file, $enhancedDir);
        } elseif ($action === 'enhance') {
            $resultUrl = $this->imageEnhancer->enhanceWithGD($file, $uploadDir);
        } else {
            // both
            $results = $this->imageEnhancer->processImage($file, $uploadDir);
            $resultUrl = $results['no_background'] ?? $results['enhanced'] ?? $results['original'];
        }

        if (!$resultUrl) {
            return $this->json(['ok' => false, 'error' => 'Processing failed'], 500);
        }

        return $this->json(['ok' => true, 'url' => $resultUrl]);
    }
}