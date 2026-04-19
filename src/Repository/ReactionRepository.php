<?php

namespace App\Repository;

use App\Entity\Reaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reaction::class);
    }

    public function findUserReactionForPost(int $postId, int $userId): ?Reaction
    {
        return $this->findOneBy([
            'post_id' => $postId,
            'user_id' => $userId,
        ]);
    }

    public function countByPostAndType(int $postId, string $type): int
    {
        return (int) $this->createQueryBuilder('r')
            ->select('COUNT(r.id)')
            ->andWhere('r.post_id = :postId')
            ->andWhere('r.type = :type')
            ->setParameter('postId', $postId)
            ->setParameter('type', $type)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countAllForPost(int $postId): int
    {
        return (int) $this->createQueryBuilder('r')
            ->select('COUNT(r.id)')
            ->andWhere('r.post_id = :postId')
            ->setParameter('postId', $postId)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getReactionCountsForPost(int $postId): array
    {
        $rows = $this->createQueryBuilder('r')
            ->select('r.type AS type, COUNT(r.id) AS count')
            ->andWhere('r.post_id = :postId')
            ->setParameter('postId', $postId)
            ->groupBy('r.type')
            ->getQuery()
            ->getArrayResult();

        $counts = [
            'like' => 0,
            'love' => 0,
            'haha' => 0,
            'wow' => 0,
            'sad' => 0,
            'angry' => 0,
        ];

        foreach ($rows as $row) {
            if (isset($counts[$row['type']])) {
                $counts[$row['type']] = (int) $row['count'];
            }
        }

        return $counts;
    }
}