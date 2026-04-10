<?php

namespace App\Controller\user;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        if ($body !== '') {
            $comment->setBody($body);
            $em->flush();
        }

        return $this->redirect($this->getRedirectUrlFromReferer($request));
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
        $isOwn = (int) $comment->getUserId() === $currentUserId;
        $isPostOwner = $comment->getPost() && (int) $comment->getPost()->getUserId() === $currentUserId;

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

        $this->addFlash('success', 'Comment deleted.');
        return $this->redirect($this->getRedirectUrlFromReferer($request));
    }

    private function getRedirectUrl(Request $request, int $postId): string
    {
        $referer = $request->headers->get('referer');
        $base = $referer ? preg_replace('/#.*$/', '', $referer) : $this->generateUrl('blog');
        return $base . '#c' . $postId;
    }

    private function getRedirectUrlFromReferer(Request $request): string
    {
        $referer = $request->headers->get('referer');
        return $referer ?: $this->generateUrl('blog');
    }
}