<?php

namespace App\Controller\admin;

use App\service\NotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/notifications', name: 'admin_notifications_')]
#[IsGranted('ROLE_ADMIN')]
class NotificationController extends AbstractController
{
    public function __construct(private NotificationService $notificationService) {}

    #[Route('/unread-count', name: 'unread_count', methods: ['GET'])]
    public function getUnreadCount(): JsonResponse
    {
        return $this->json([
            'count' => $this->notificationService->getUnreadCount()
        ]);
    }

    #[Route('/recent', name: 'recent', methods: ['GET'])]
    public function getRecent(): JsonResponse
    {
        $notifications = $this->notificationService->getRecentNotifications(20);
        
        $data = array_map(function($n) {
            return [
                'id' => $n->getId(),
                'title' => $n->getTitle(),
                'message' => $n->getMessage(),
                'type' => $n->getType(),
                'isRead' => $n->isRead(),
                'relatedId' => $n->getRelatedId(),
                'relatedType' => $n->getRelatedType(),
                'createdAt' => $n->getCreatedAt()->format('Y-m-d H:i:s'),
                'timeAgo' => $this->getTimeAgo($n->getCreatedAt()),
                'redirectUrl' => $this->generateUrl('admin_accommodations_bookings_index')
            ];
        }, $notifications);
        
        return $this->json($data);
    }

    #[Route('/mark-read/{id}', name: 'mark_read', methods: ['POST'])]
    public function markAsRead(int $id): JsonResponse
    {
        $this->notificationService->markAsRead($id);
        return $this->json(['success' => true]);
    }

    #[Route('/mark-all-read', name: 'mark_all_read', methods: ['POST'])]
    public function markAllAsRead(): JsonResponse
    {
        $this->notificationService->markAllAsRead();
        return $this->json(['success' => true]);
    }

    #[Route('/test', name: 'test', methods: ['GET'])]
    public function testNotification(): JsonResponse
    {
        $this->notificationService->createNewBookingNotification(
            999,
            'Test User',
            'Test Hotel'
        );
        return $this->json(['success' => true, 'message' => 'Test notification created']);
    }

    private function getTimeAgo(\DateTimeImmutable $dateTime): string
    {
        $now = new \DateTime();
        $diff = $now->diff($dateTime);
        
        if ($diff->i < 1) return 'Just now';
        if ($diff->i < 60) return $diff->i . ' min ago';
        if ($diff->h < 24) return $diff->h . ' hours ago';
        return $diff->d . ' days ago';
    }
}