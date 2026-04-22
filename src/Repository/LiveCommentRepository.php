<?php

namespace App\Repository;

use App\Entity\LiveComment;
use App\Entity\LiveSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LiveCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LiveComment::class);
    }

    /**
     * @return LiveComment[]
     */
    public function findLatestForSession(LiveSession $session, int $limit = 40): array
    {
        $rows = $this->createQueryBuilder('lc')
            ->leftJoin('lc.user', 'u')
            ->addSelect('u')
            ->where('lc.liveSession = :session')
            ->setParameter('session', $session)
            ->orderBy('lc.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        return array_reverse($rows);
    }
}
