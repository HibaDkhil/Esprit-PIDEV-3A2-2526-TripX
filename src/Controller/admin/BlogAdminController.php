<?php

namespace App\Controller\admin;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Reaction;
use App\Entity\TravelStory;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        // Build author map from both
        $authorIds = array_unique(array_filter(array_merge(
            array_map(fn($p) => $p->getUserId(), $posts),
            array_map(fn($s) => $s->getUserId(), $stories)
        )));
        $authorMap = [];
        foreach ($authorIds as $uid) {
            $u = $em->getRepository(User::class)->find($uid);
            if ($u) {
                $authorMap[$uid] = $u->getFirstName() . ' ' . $u->getLastName();
            }
        }

        $allComments   = $em->getRepository(Comment::class)->findBy([], ['created_at' => 'DESC']);
        $allReactions  = $em->getRepository(Reaction::class)->findBy([]);

        // Reaction breakdown by type
        $reactionBreakdown = [];
        foreach ($allReactions as $r) {
            $reactionBreakdown[$r->getType()] = ($reactionBreakdown[$r->getType()] ?? 0) + 1;
        }
        arsort($reactionBreakdown);

        // Extend authorMap with comment authors
        foreach ($allComments as $c) {
            $uid = $c->getUserId();
            if ($uid && !isset($authorMap[$uid])) {
                $u = $em->getRepository(User::class)->find($uid);
                if ($u) $authorMap[$uid] = $u->getFirstName() . ' ' . $u->getLastName();
            }
        }

        $stats = [
            'total'     => count($posts),
            'pending'   => count(array_filter($posts, fn($p) => !$p->isConfirmed())),
            'approved'  => count(array_filter($posts, fn($p) => $p->isConfirmed())),
            'stories'   => count($stories),
            'comments'  => count($allComments),
            'reactions' => count($allReactions),
        ];

        return $this->render('admin/blog/blog.html.twig', [
            'posts'             => $posts,
            'stories'           => $stories,
            'authorMap'         => $authorMap,
            'stats'             => $stats,
            'allComments'       => $allComments,
            'reactionBreakdown' => $reactionBreakdown,
        ]);
    }

    // ── Approve a post ──────────────────────────────────────────────────
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
            $this->addFlash('success', 'Post approved.');
        }

        return $this->redirectToRoute('admin_blog');
    }

    // ── Reject a post ───────────────────────────────────────────────────
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
            $this->addFlash('info', 'Post rejected.');
        }

        return $this->redirectToRoute('admin_blog');
    }

    // ── Delete a post ───────────────────────────────────────────────────
    #[Route('/{id}/delete', name: 'admin_blog_delete', methods: ['POST'])]
    public function delete(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            throw $this->createNotFoundException('Post not found.');
        }

        if ($this->isCsrfTokenValid('admin_blog_delete_' . $id, $request->request->get('_token'))) {
            $em->remove($post);
            $em->flush();
            $this->addFlash('success', 'Post deleted.');
        }

        return $this->redirectToRoute('admin_blog');
    }

    // ── Delete a travel story ───────────────────────────────────────────
    #[Route('/story/{id}/delete', name: 'admin_story_delete', methods: ['POST'])]
    public function deleteStory(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $story = $em->getRepository(TravelStory::class)->find($id);
        if (!$story) {
            throw $this->createNotFoundException('Travel story not found.');
        }

        if ($this->isCsrfTokenValid('admin_story_delete_' . $id, $request->request->get('_token'))) {
            $em->remove($story);
            $em->flush();
            $this->addFlash('success', 'Travel story deleted.');
        }

        return $this->redirectToRoute('admin_blog');
    }

    // ── Show a post (with comments & reactions) ─────────────────────────
    #[Route('/{id}/show', name: 'admin_blog_show')]
    public function showPost(int $id, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            throw $this->createNotFoundException('Post not found.');
        }

        $userIds = array_unique(array_filter(array_merge(
            [$post->getUserId()],
            array_map(fn($c) => $c->getUserId(), $post->getComments()->toArray())
        )));
        $authorMap = [];
        foreach ($userIds as $uid) {
            $u = $em->getRepository(User::class)->find($uid);
            if ($u) $authorMap[$uid] = $u->getFirstName() . ' ' . $u->getLastName();
        }

        $reactions = $em->getRepository(Reaction::class)->findBy(['post_id' => $post->getId()]);
        $reactionCounts = [];
        foreach ($reactions as $r) {
            $reactionCounts[$r->getType()] = ($reactionCounts[$r->getType()] ?? 0) + 1;
        }
        arsort($reactionCounts);

        return $this->render('admin/blog/post_show.html.twig', [
            'post'           => $post,
            'authorMap'      => $authorMap,
            'reactionCounts' => $reactionCounts,
            'totalReactions' => count($reactions),
        ]);
    }

    // ── Show a travel story (with comments & reactions) ──────────────────
    #[Route('/story/{id}/show', name: 'admin_story_show')]
    public function showStory(int $id, EntityManagerInterface $em): Response
    {
        $story = $em->getRepository(TravelStory::class)->find($id);
        if (!$story) {
            throw $this->createNotFoundException('Travel story not found.');
        }

        $comments = $em->getRepository(Comment::class)->findBy(
            ['travel_story_id' => $story->getId()],
            ['created_at' => 'DESC']
        );

        $userIds = array_unique(array_filter(array_merge(
            [$story->getUserId()],
            array_map(fn($c) => $c->getUserId(), $comments)
        )));
        $authorMap = [];
        foreach ($userIds as $uid) {
            $u = $em->getRepository(User::class)->find($uid);
            if ($u) $authorMap[$uid] = $u->getFirstName() . ' ' . $u->getLastName();
        }

        $reactions = $em->getRepository(Reaction::class)->findBy(['travel_story_id' => $story->getId()]);
        $reactionCounts = [];
        foreach ($reactions as $r) {
            $reactionCounts[$r->getType()] = ($reactionCounts[$r->getType()] ?? 0) + 1;
        }
        arsort($reactionCounts);

        return $this->render('admin/blog/story_show.html.twig', [
            'story'          => $story,
            'authorName'     => $authorMap[$story->getUserId()] ?? 'User #' . $story->getUserId(),
            'authorMap'      => $authorMap,
            'comments'       => $comments,
            'reactionCounts' => $reactionCounts,
            'totalReactions' => count($reactions),
        ]);
    }

    // ── Delete a comment ────────────────────────────────────────────────
    #[Route('/comment/{id}/delete', name: 'admin_comment_delete', methods: ['POST'])]
    public function deleteComment(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $comment = $em->getRepository(Comment::class)->find($id);
        if (!$comment) {
            throw $this->createNotFoundException('Comment not found.');
        }

        $referer = $request->headers->get('referer', $this->generateUrl('admin_blog'));

        if ($this->isCsrfTokenValid('admin_comment_delete_' . $id, $request->request->get('_token'))) {
            $em->remove($comment);
            $em->flush();
            $this->addFlash('success', 'Comment deleted.');
        }

        return $this->redirect($referer);
    }
}