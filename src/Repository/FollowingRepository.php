<?php

namespace App\Repository;

use App\Entity\Following;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FollowingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Following::class);
    }

    /**
     * Get list of user IDs that a given user is following (accepted only).
     */
    public function getFollowingIds(int $userId): array
    {
        $results = $this->createQueryBuilder('f')
            ->select('f.followed_id')
            ->where('f.follower_id = :userId')
            ->andWhere('f.status = :status')
            ->setParameter('userId', $userId)
            ->setParameter('status', Following::STATUS_ACCEPTED)
            ->getQuery()
            ->getScalarResult();

        return array_column($results, 'followed_id');
    }

    /**
     * Get list of user IDs who follow a given user (accepted only).
     */
    public function getFollowerIds(int $userId): array
    {
        $results = $this->createQueryBuilder('f')
            ->select('f.follower_id')
            ->where('f.followed_id = :userId')
            ->andWhere('f.status = :status')
            ->setParameter('userId', $userId)
            ->setParameter('status', Following::STATUS_ACCEPTED)
            ->getQuery()
            ->getScalarResult();

        return array_column($results, 'follower_id');
    }

    /**
     * Find pending follow requests for a given user.
     */
    public function findPendingRequests(int $userId): array
    {
        return $this->createQueryBuilder('f')
            ->where('f.followed_id = :userId')
            ->andWhere('f.status = :status')
            ->setParameter('userId', $userId)
            ->setParameter('status', Following::STATUS_PENDING)
            ->orderBy('f.created_at', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
