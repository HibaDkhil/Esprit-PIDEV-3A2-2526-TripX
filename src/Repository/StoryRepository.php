<?php

namespace App\Repository;

use App\Entity\Story;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class StoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Story::class);
    }

    /**
     * Returns non-expired stories ordered oldest->newest per user viewing sequence.
     */
    public function findActive(?int $userId = null, bool $includeRemoved = false): array
    {
        $qb = $this->createQueryBuilder('s')
            ->leftJoin('s.user', 'u')
            ->addSelect('u')
            ->where('s.expiresAt > :now')
            ->setParameter('now', new \DateTimeImmutable())
            ->orderBy('s.createdAt', 'ASC');

        if (!$includeRemoved) {
            $qb->andWhere('s.removedByAdmin = :notRemoved')
                ->setParameter('notRemoved', false);
        }

        if ($userId !== null) {
            $qb->andWhere('u.userId = :uid')
                ->setParameter('uid', $userId);
        }

        return $qb->getQuery()->getResult();
    }

    public function findActiveForUser(int $userId): array
    {
        return $this->findActive($userId, false);
    }

    public function findExpiredForUser(int $userId): array
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.user', 'u')
            ->addSelect('u')
            ->where('u.userId = :uid')
            ->andWhere('s.expiresAt <= :now')
            ->setParameter('uid', $userId)
            ->setParameter('now', new \DateTimeImmutable())
            ->orderBy('s.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
