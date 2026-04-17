<?php

namespace App\service;

use App\Entity\AdminNotification;
use App\Repository\AdminNotificationRepository;
use Doctrine\ORM\EntityManagerInterface;

class NotificationService
{
    public function __construct(
        private EntityManagerInterface $em,
        private AdminNotificationRepository $notificationRepo
    ) {}

    public function createNewBookingNotification(int $bookingId, string $userName, string $accommodationName, ?int $accommodationId = null): void
    {
        $notification = new AdminNotification();
        $notification->setTitle('🆕 New Booking Received!');
        $notification->setMessage(sprintf(
            '%s has made a new booking at %s. Click to review and confirm.',
            $userName,
            $accommodationName
        ));
        $notification->setType('booking');
        $notification->setRelatedId($bookingId);
        $notification->setRelatedType('booking');

        $this->em->persist($notification);
        $this->em->flush();
    }

    public function getUnreadCount(): int
    {
        return $this->notificationRepo->findUnreadCount();
    }

    public function getRecentNotifications(int $limit = 20): array
    {
        return $this->notificationRepo->findRecentNotifications($limit);
    }

    public function markAsRead(int $id): void
    {
        $notification = $this->notificationRepo->find($id);
        if ($notification) {
            $notification->setIsRead(true);
            $this->em->flush();
        }
    }

    public function markAllAsRead(): void
    {
        $this->notificationRepo->markAllAsRead();
    }
}