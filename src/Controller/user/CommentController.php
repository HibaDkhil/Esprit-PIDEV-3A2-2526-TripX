<?php

namespace App\Controller\user;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\TravelStory;
use App\Entity\User;
use App\Repository\FollowingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment/create/{id}', name: 'comment_create', methods: ['POST'])]
    public function create(int $id, Request $request, EntityManagerInterface $em): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();

        if (!$user instanceof User) {
            $this->addFlash('error', 'You must be logged in to comment.');
            return $this->redirectToRoute('blog');
        }

        $post = $em->getRepository(Post::class)->find($id);

        if (!$post) {
            $this->addFlash('error', 'Post not found.');
            return $this->redirectToRoute('blog');
        }

        $body = trim((string) $request->request->get('body', ''));
        if ($body === '') {
            $this->addFlash('error', 'Comment cannot be empty.');
            return $this->redirect($this->getRedirectUrl($request, $id));
        }

        if (mb_strlen($body) < 2) {
            $this->addFlash('error', 'Comment must be at least 2 characters.');
            return $this->redirect($this->getRedirectUrl($request, $id));
        }

        $parentId = $request->request->get('parent_comment_id');
        $parentId = ($parentId !== null && $parentId !== '') ? (int) $parentId : null;

        $comment = new Comment();
        $comment->setPost($post);
        $comment->setTravelStoryId(null);
        $comment->setUserId((int) $user->getUserId());
        $comment->setParentCommentId($parentId);
        $comment->setBody($body);
        $comment->setCreatedAt(new \DateTime());

        try {
            $em->persist($comment);
            $em->flush();
        } catch (\Throwable $e) {
            $this->addFlash('error', 'Comment failed: ' . $e->getMessage());
            return $this->redirect($this->getRedirectUrl($request, $id));
        }

        $this->addFlash('success', 'Comment added.');
        return $this->redirect($this->getRedirectUrl($request, $id));
    }

    #[Route('/comment/create-ajax/{id}', name: 'comment_create_ajax', methods: ['POST'])]
    public function createAjax(int $id, Request $request, EntityManagerInterface $em): JsonResponse
    {
        /** @var User|null $user */
        $user = $this->getUser();

        if (!$user instanceof User) {
            return $this->json(['error' => 'You must be logged in to comment.'], Response::HTTP_UNAUTHORIZED);
        }

        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            return $this->json(['error' => 'Post not found.'], Response::HTTP_NOT_FOUND);
        }

        $body = trim((string) $request->request->get('body', ''));

        if ($body === '') {
            return $this->json(['error' => 'Comment cannot be empty.'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (mb_strlen($body) < 2) {
            return $this->json(['error' => 'Comment must be at least 2 characters.'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (mb_strlen($body) > 2000) {
            return $this->json(['error' => 'Comment is too long (max 2000 characters).'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $parentId = $request->request->get('parent_comment_id');
        $parentId = ($parentId !== null && $parentId !== '') ? (int) $parentId : null;

        $comment = new Comment();
        $comment->setPost($post);
        $comment->setTravelStoryId(null);
        $comment->setUserId((int) $user->getUserId());
        $comment->setParentCommentId($parentId);
        $comment->setBody($body);
        $comment->setCreatedAt(new \DateTime());

        try {
            $em->persist($comment);
            $em->flush();
        } catch (\Throwable $e) {
            return $this->json(['error' => 'Comment failed: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $firstName = $user->getFirstName() ?? '';
        $lastName  = $user->getLastName() ?? '';
        $fullName  = trim($firstName . ' ' . $lastName) ?: 'User #' . $user->getUserId();

        return $this->json([
            'success'    => true,
            'comment'    => [
                'id'        => $comment->getId(),
                'body'      => $comment->getBody(),
                'author'    => $fullName,
                'authorId'  => $user->getUserId(),
                'parentId'  => $comment->getParentCommentId(),
                'createdAt' => $comment->getCreatedAt()->format('M d · H:i'),
            ],
        ]);
    }

    #[Route('/comment/create-story-ajax/{id}', name: 'comment_create_story_ajax', methods: ['POST'])]
    public function createStoryAjax(int $id, Request $request, EntityManagerInterface $em): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->json(['error' => 'Not logged in'], Response::HTTP_UNAUTHORIZED);
        }

        $story = $em->getRepository(TravelStory::class)->find($id);
        if (!$story) {
            return $this->json(['error' => 'Story not found'], Response::HTTP_NOT_FOUND);
        }

        $body = trim((string) $request->request->get('body', ''));
        if (mb_strlen($body) < 2) {
            return $this->json(['error' => 'Comment must be at least 2 characters.'], Response::HTTP_BAD_REQUEST);
        }

        $parentId = $request->request->get('parent_comment_id');
        $parentId = ($parentId !== null && $parentId !== '') ? (int) $parentId : null;

        $comment = new Comment();
        $comment->setPost(null);
        $comment->setTravelStoryId($id);
        $comment->setUserId((int) $user->getUserId());
        $comment->setParentCommentId($parentId);
        $comment->setBody($body);
        $comment->setCreatedAt(new \DateTime());

        try {
            $em->persist($comment);
            $em->flush();
        } catch (\Throwable $e) {
            return $this->json(['error' => 'Comment failed: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $firstName = $user->getFirstName() ?? '';
        $lastName  = $user->getLastName() ?? '';
        $fullName  = trim($firstName . ' ' . $lastName) ?: 'User #' . $user->getUserId();

        return $this->json([
            'success'    => true,
            'comment'    => [
                'id'        => $comment->getId(),
                'body'      => $comment->getBody(),
                'author'    => $fullName,
                'authorId'  => $user->getUserId(),
                'parentId'  => $comment->getParentCommentId(),
                'createdAt' => $comment->getCreatedAt()->format('M d · H:i'),
            ],
        ]);
    }

    #[Route('/comment/{id}/edit', name: 'comment_edit', methods: ['POST'])]
    public function edit(int $id, Request $request, EntityManagerInterface $em): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        $comment = $em->find(Comment::class, $id);
        if (!$comment) {
            throw $this->createNotFoundException();
        }

        if ((int) $comment->getUserId() !== (int) $user->getUserId()) {
            $this->addFlash('error', 'You can only edit your own comments.');
            return $this->redirect($this->getRedirectUrlFromReferer($request));
        }

        if (!$this->isCsrfTokenValid('edit_comment_' . $id, $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid token.');
            return $this->redirect($this->getRedirectUrlFromReferer($request));
        }

        $body = trim((string) $request->request->get('body', ''));
        if ($body !== '' && mb_strlen($body) >= 2) {
            $comment->setBody($body);
            $em->flush();
        }

        // AJAX response
        if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
            return $this->json(['success' => true, 'body' => $comment->getBody()]);
        }

        return $this->redirect($this->getRedirectUrlFromReferer($request));
    }

    #[Route('/comment/{id}/edit-ajax', name: 'comment_edit_ajax', methods: ['POST'])]
    public function editAjax(int $id, Request $request, EntityManagerInterface $em): JsonResponse
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->json(['error' => 'Not logged in'], Response::HTTP_UNAUTHORIZED);
        }

        $comment = $em->find(Comment::class, $id);
        if (!$comment) {
            return $this->json(['error' => 'Not found'], Response::HTTP_NOT_FOUND);
        }

        if ((int) $comment->getUserId() !== (int) $user->getUserId()) {
            return $this->json(['error' => 'Forbidden'], Response::HTTP_FORBIDDEN);
        }

        if (!$this->isCsrfTokenValid('edit_comment_' . $id, $request->request->get('_token'))) {
            return $this->json(['error' => 'Invalid token'], Response::HTTP_FORBIDDEN);
        }

        $body = trim((string) $request->request->get('body', ''));
        if ($body === '' || mb_strlen($body) < 2) {
            return $this->json(['error' => 'Comment too short'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $comment->setBody($body);
        $em->flush();

        return $this->json(['success' => true, 'body' => $comment->getBody()]);
    }

    #[Route('/comment/{id}/delete', name: 'comment_delete', methods: ['POST'])]
    public function delete(int $id, Request $request, EntityManagerInterface $em): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        $comment = $em->find(Comment::class, $id);
        if (!$comment) {
            throw $this->createNotFoundException();
        }

        $currentUserId = (int) $user->getUserId();
        $isOwn         = (int) $comment->getUserId() === $currentUserId;
        $isPostOwner   = $comment->getPost() && (int) $comment->getPost()->getUserId() === $currentUserId;

        if (!$isOwn && !$isPostOwner) {
            $this->addFlash('error', 'You cannot delete this comment.');
            return $this->redirect($this->getRedirectUrlFromReferer($request));
        }

        if (!$this->isCsrfTokenValid('delete_comment_' . $id, $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid token.');
            return $this->redirect($this->getRedirectUrlFromReferer($request));
        }

        foreach ($em->getRepository(Comment::class)->findBy(['parent_comment_id' => $id]) as $reply) {
            $em->remove($reply);
        }

        $em->remove($comment);
        $em->flush();

        if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
            return $this->json(['success' => true]);
        }

        $this->addFlash('success', 'Comment deleted.');
        return $this->redirect($this->getRedirectUrlFromReferer($request));
    }

    private function getRedirectUrl(Request $request, int $postId): string
    {
        $referer = $request->headers->get('referer');
        $base    = $referer ? preg_replace('/#.*$/', '', $referer) : $this->generateUrl('blog');
        return $base . '#c' . $postId;
    }

    private function getRedirectUrlFromReferer(Request $request): string
    {
        $referer = $request->headers->get('referer');
        return $referer ?: $this->generateUrl('blog');
    }
}