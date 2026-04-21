<?php

namespace App\Repository;

use App\Entity\LiveSession;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LiveSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LiveSession::class);
    }

    /**
     * @return LiveSession[]
     */
    public function findActiveOrdered(int $limit = 24): array
    {
        return $this->createQueryBuilder('ls')
            ->leftJoin('ls.hostUser', 'u')
            ->addSelect('u')
            ->where('ls.status = :live')
            ->setParameter('live', 'live')
            ->orderBy('ls.startedAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findLiveByHost(User $host): ?LiveSession
    {
        return $this->createQueryBuilder('ls')
            ->where('ls.hostUser = :host')
            ->andWhere('ls.status = :live')
            ->setParameter('host', $host)
            ->setParameter('live', 'live')
            ->orderBy('ls.startedAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return LiveSession[]
     */
    public function findSavedEndedByHostUserId(int $hostUserId, int $limit = 48, bool $includeRemoved = false): array
    {
        $qb = $this->createQueryBuilder('ls')
            ->leftJoin('ls.hostUser', 'u')
            ->addSelect('u')
            ->where('IDENTITY(ls.hostUser) = :hostUserId')
            ->andWhere('ls.status = :ended')
            ->andWhere('ls.savedToProfile = :saved')
            ->setParameter('hostUserId', $hostUserId)
            ->setParameter('ended', 'ended')
            ->setParameter('saved', true)
            ->orderBy('ls.savedToProfileAt', 'DESC')
            ->addOrderBy('ls.endedAt', 'DESC')
            ->setMaxResults($limit);

        if (!$includeRemoved) {
            $qb->andWhere('ls.removedByAdmin = :notRemoved')
                ->setParameter('notRemoved', false);
        }

        return $qb->getQuery()->getResult();
    }
}
