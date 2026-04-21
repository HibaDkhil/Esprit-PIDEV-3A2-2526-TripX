<?php

namespace App\Repository;

use App\Entity\BlogNotification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BlogNotificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogNotification::class);
    }

    /**
     * Fetch unread notifications for a user (newest first).
     *
     * @return BlogNotification[]
     */
    public function findUnreadForUser(int $userId, int $limit = 15): array
    {
        return $this->createQueryBuilder('n')
            ->where('n.userId = :uid')
            ->andWhere('n.isRead = false')
            ->setParameter('uid', $userId)
            ->orderBy('n.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Mark all of a user's notifications as read in a single UPDATE query.
     */
    public function markAllReadForUser(int $userId): void
    {
        $this->createQueryBuilder('n')
            ->update()
            ->set('n.isRead', ':r')
            ->where('n.userId = :uid')
            ->andWhere('n.isRead = false')
            ->setParameter('r', true)
            ->setParameter('uid', $userId)
            ->getQuery()
            ->execute();
    }
}
