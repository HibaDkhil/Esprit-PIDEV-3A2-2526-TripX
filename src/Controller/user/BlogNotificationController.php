<?php

namespace App\Controller\user;

use App\Entity\BlogNotification;
use App\Repository\BlogNotificationRepository;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Serves moderation notifications to the authenticated user.
 * Returns them as JSON (for a badge/dropdown) and as a rendered partial.
 */
#[Route('/blog/notifications')]
class BlogNotificationController extends AbstractController
{
    #[Route('', name: 'blog_notifications_index', methods: ['GET'])]
    public function index(BlogNotificationRepository $repo): Response
    {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User) {
            return $this->json(['ok' => false], Response::HTTP_UNAUTHORIZED);
        }

        $notifications = $repo->findUnreadForUser((int) $me->getUserId());

        return $this->render('blog/notifications/_list.html.twig', [
            'notifications' => $notifications,
        ]);
    }

    #[Route('/count', name: 'blog_notifications_count', methods: ['GET'])]
    public function count(BlogNotificationRepository $repo): JsonResponse
    {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User) {
            return $this->json(['count' => 0]);
        }

        $count = count($repo->findUnreadForUser((int) $me->getUserId()));

        return $this->json(['count' => $count]);
    }

    #[Route('/mark-read', name: 'blog_notifications_mark_read', methods: ['POST'])]
    public function markRead(BlogNotificationRepository $repo): JsonResponse
    {
        /** @var User|null $me */
        $me = $this->getUser();
        if (!$me instanceof User) {
            return $this->json(['ok' => false], Response::HTTP_UNAUTHORIZED);
        }

        $repo->markAllReadForUser((int) $me->getUserId());

        return $this->json(['ok' => true]);
    }
}
