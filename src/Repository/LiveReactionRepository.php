<?php

namespace App\Repository;

use App\Entity\LiveReaction;
use App\Entity\LiveSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LiveReactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LiveReaction::class);
    }

    /**
     * @return array<string,int>
     */
    public function countByTypeForSession(LiveSession $session): array
    {
        $rows = $this->createQueryBuilder('lr')
            ->select('lr.type AS type', 'COUNT(lr.id) AS cnt')
            ->where('lr.liveSession = :session')
            ->setParameter('session', $session)
            ->groupBy('lr.type')
            ->getQuery()
            ->getArrayResult();

        $out = [];
        foreach ($rows as $row) {
            $type = strtolower(trim((string) ($row['type'] ?? '')));
            if ($type === '') {
                continue;
            }
            $out[$type] = (int) ($row['cnt'] ?? 0);
        }

        return $out;
    }
}
