<?php

namespace App\Controller\user;

use App\Entity\Post;
use App\Entity\SavedPost;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SavedPostController extends AbstractController
{
    // ── Toggle save / unsave ─────────────────────────────────────────────
    #[Route('/post/{id}/save', name: 'post_save_toggle', methods: ['POST'])]
    public function toggle(int $id, Request $request, EntityManagerInterface $em): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();

        if (!$user instanceof User) {
            $this->addFlash('error', 'You must be logged in to save posts.');
            return $this->redirectToRoute('blog');
        }

        $post = $em->getRepository(Post::class)->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Post not found.');
        }

        if (!$this->isCsrfTokenValid('save_post_' . $id, $request->request->get('_token'))) {
            $this->addFlash('error', 'Invalid token.');
            return $this->redirectToRoute('blog');
        }

        $userId    = $user->getId();
        $existing  = $em->getRepository(SavedPost::class)->findOneBy([
            'user_id' => $userId,
            'post_id' => $id,
        ]);

        if ($existing) {
            $em->remove($existing);
            $em->flush();
            $this->addFlash('info', 'Post removed from saved.');
        } else {
            $saved = new SavedPost();
            $saved->setUserId($userId);
            $saved->setPostId($id);
            $saved->setSavedAt(new \DateTime());
            $em->persist($saved);
            $em->flush();
            $this->addFlash('success', 'Post saved!');
        }

        $referer = $request->headers->get('referer');
        if ($referer) {
            return $this->redirect($referer);
        }

        return $this->redirectToRoute('blog');
    }

    // ── List saved posts ─────────────────────────────────────────────────
    #[Route('/blog/saved', name: 'blog_saved')]
    public function saved(EntityManagerInterface $em): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();

        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        $savedEntries = $em->getRepository(SavedPost::class)->findBy(
            ['user_id' => $user->getId()],
            ['saved_at' => 'DESC']
        );

        $posts = [];
        foreach ($savedEntries as $entry) {
            $post = $em->getRepository(Post::class)->find($entry->getPostId());
            if ($post) {
                $posts[] = $post;
            }
        }

        return $this->render('front/blog/saved_posts.html.twig', [
            'posts' => $posts,
        ]);
    }
}