<?php

namespace App\Controller\admin;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\TravelStory;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/blog')]
class BlogAdminController extends AbstractController
{
    // ── List all posts + travel stories ──────────────────────────────────
    #[Route('', name: 'admin_blog')]
    public function index(EntityManagerInterface $em): Response
    {
        $posts   = $em->getRepository(Post::class)->findBy([], ['id' => 'DESC']);
        $stories = $em->getRepository(TravelStory::class)->findBy([], ['createdAt' => 'DESC']);
        $comments = $em->getRepository(Comment::class)->findBy([], ['created_at' => 'DESC'], 200);

        // Build author map
        $authorIds = array_unique(array_filter(array_merge(
            array_map(fn($p) => $p->getUserId(), $posts),
            array_map(fn($s) => $s->getUserId(), $stories),
            array_map(fn($c) => $c->getUserId(), $comments)
        )));
        $authorMap = [];
        foreach ($authorIds as $uid) {
            $u = $em->getRepository(User::class)->find($uid);
            if ($u) {
                $authorMap[$uid] = trim($u->getFirstName() . ' ' . $u->getLastName()) ?: 'User #' . $uid;
            }
        }

        $pending  = array_filter($posts, fn($p) => !$p->isConfirmed());
        $approved = array_filter($posts, fn($p) => $p->isConfirmed());

        $stats = [
            'total'    => count($posts),
            'pending'  => count($pending),
            'approved' => count($approved),
            'stories'  => count($stories),
            'comments' => count($comments),
        ];

        return $this->render('admin/blog/blog.html.twig', [
            'posts'     => $posts,
            'stories'   => $stories,
            'comments'  => $comments,
            'authorMap' => $authorMap,
            'stats'     => $stats,
        ]);
    }

    // ── Show Post (Admin) ────────────────────────────────────────────────
    #[Route('/post/{id}', name: 'admin_post_show', methods: ['GET'])]
    public function showPost(int $id, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) throw $this->createNotFoundException('Post not found.');

        // Build author map for post + comments
        $authorIds = array_unique(array_filter(array_merge(
            [$post->getUserId()],
            array_map(fn($c) => $c->getUserId(), $post->getComments()->toArray())
        )));
        $authorMap = [];
        foreach ($authorIds as $uid) {
            $u = $em->getRepository(User::class)->find($uid);
            if ($u) {
                $authorMap[$uid] = trim($u->getFirstName() . ' ' . $u->getLastName()) ?: 'User #' . $uid;
            }
        }

        return $this->render('admin/blog/post_show.html.twig', [
            'post'      => $post,
            'authorMap' => $authorMap,
        ]);
    }

    // ── Show Travel Story (Admin) ────────────────────────────────────────
    #[Route('/story/{id}', name: 'admin_story_show', methods: ['GET'])]
    public function showStory(int $id, EntityManagerInterface $em): Response
    {
        $story = $em->getRepository(TravelStory::class)->find($id);
        if (!$story) throw $this->createNotFoundException('Story not found.');

        $u = $em->getRepository(User::class)->find($story->getUserId());
        $authorName = $u ? trim($u->getFirstName() . ' ' . $u->getLastName()) : 'User #' . $story->getUserId();

        return $this->render('admin/blog/story_show.html.twig', [
            'story'      => $story,
            'authorName' => $authorName,
        ]);
    }

    // ── Approve a post ───────────────────────────────────────────────────
    #[Route('/{id}/approve', name: 'admin_blog_approve', methods: ['POST'])]
    public function approve(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            throw $this->createNotFoundException('Post not found.');
        }

        if ($this->isCsrfTokenValid('admin_blog_' . $id, $request->request->get('_token'))) {
            $post->setIsConfirmed(true);
            $em->flush();

            if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return $this->json(['success' => true, 'status' => 'approved']);
            }
            $this->addFlash('success', 'Post approved.');
        }

        return $this->redirectToRoute('admin_blog');
    }

    // ── Reject a post ────────────────────────────────────────────────────
    #[Route('/{id}/reject', name: 'admin_blog_reject', methods: ['POST'])]
    public function reject(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            throw $this->createNotFoundException('Post not found.');
        }

        if ($this->isCsrfTokenValid('admin_blog_' . $id, $request->request->get('_token'))) {
            $post->setIsConfirmed(false);
            $em->flush();

            if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return $this->json(['success' => true, 'status' => 'rejected']);
            }
            $this->addFlash('info', 'Post rejected.');
        }

        return $this->redirectToRoute('admin_blog');
    }

    // ── Edit a post (admin) ───────────────────────────────────────────────
    #[Route('/{id}/edit', name: 'admin_blog_edit', methods: ['POST'])]
    public function edit(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return $this->json(['error' => 'Post not found'], Response::HTTP_NOT_FOUND);
            }
            throw $this->createNotFoundException();
        }

        if (!$this->isCsrfTokenValid('admin_blog_edit_' . $id, $request->request->get('_token'))) {
            if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return $this->json(['error' => 'Invalid token'], Response::HTTP_FORBIDDEN);
            }
            $this->addFlash('error', 'Invalid token.');
            return $this->redirectToRoute('admin_blog');
        }

        $title = trim((string) $request->request->get('title', ''));
        $body  = trim((string) $request->request->get('body', ''));
        $type  = trim((string) $request->request->get('type', ''));

        $allowedTypes = ['inquiry', 'story', 'review', 'advice', 'other'];

        $errors = [];
        if ($title === '' || mb_strlen($title) < 3) {
            $errors[] = 'Title must be at least 3 characters.';
        }
        if ($body === '' || mb_strlen($body) < 10) {
            $errors[] = 'Body must be at least 10 characters.';
        }
        if (!in_array($type, $allowedTypes, true)) {
            $errors[] = 'Invalid post type.';
        }

        if (!empty($errors)) {
            if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return $this->json(['error' => implode(' ', $errors)], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $this->addFlash('error', implode(' ', $errors));
            return $this->redirectToRoute('admin_blog');
        }

        $post->setTitle($title);
        $post->setBody($body);
        $post->setType($type);
        $post->setUpdatedAt(new \DateTime());
        $em->flush();

        if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
            return $this->json([
                'success' => true,
                'title'   => $post->getTitle(),
                'body'    => $post->getBody(),
                'type'    => $post->getType(),
            ]);
        }

        $this->addFlash('success', 'Post updated.');
        return $this->redirectToRoute('admin_blog');
    }

    // ── Delete a post ────────────────────────────────────────────────────
    #[Route('/{id}/delete', name: 'admin_blog_delete', methods: ['POST'])]
    public function delete(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return $this->json(['error' => 'Not found'], Response::HTTP_NOT_FOUND);
            }
            throw $this->createNotFoundException();
        }

        if ($this->isCsrfTokenValid('admin_blog_delete_' . $id, $request->request->get('_token'))) {
            $em->remove($post);
            $em->flush();

            if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return $this->json(['success' => true]);
            }
            $this->addFlash('success', 'Post deleted.');
        }

        return $this->redirectToRoute('admin_blog');
    }

    // ── Delete a travel story ─────────────────────────────────────────────
    #[Route('/story/{id}/delete', name: 'admin_story_delete', methods: ['POST'])]
    public function deleteStory(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $story = $em->getRepository(TravelStory::class)->find($id);
        if (!$story) {
            if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return $this->json(['error' => 'Not found'], Response::HTTP_NOT_FOUND);
            }
            throw $this->createNotFoundException();
        }

        if ($this->isCsrfTokenValid('admin_story_delete_' . $id, $request->request->get('_token'))) {
            $em->remove($story);
            $em->flush();

            if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return $this->json(['success' => true]);
            }
            $this->addFlash('success', 'Travel story deleted.');
        }

        return $this->redirectToRoute('admin_blog');
    }

    // ── Delete a comment (admin) ──────────────────────────────────────────
    #[Route('/comment/{id}/delete', name: 'admin_comment_delete', methods: ['POST'])]
    public function deleteComment(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $comment = $em->getRepository(Comment::class)->find($id);
        if (!$comment) {
            if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return $this->json(['error' => 'Not found'], Response::HTTP_NOT_FOUND);
            }
            throw $this->createNotFoundException();
        }

        if ($this->isCsrfTokenValid('admin_comment_delete_' . $id, $request->request->get('_token'))) {
            // also delete replies
            foreach ($em->getRepository(Comment::class)->findBy(['parent_comment_id' => $id]) as $reply) {
                $em->remove($reply);
            }
            $em->remove($comment);
            $em->flush();

            if ($request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return $this->json(['success' => true]);
            }
            $this->addFlash('success', 'Comment deleted.');
        }

        return $this->redirectToRoute('admin_blog');
    }
}