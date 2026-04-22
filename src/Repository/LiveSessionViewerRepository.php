<?php

namespace App\Repository;

use App\Entity\LiveSession;
use App\Entity\LiveSessionViewer;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LiveSessionViewerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LiveSessionViewer::class);
    }

    public function countActiveBySession(LiveSession $session): int
    {
        return (int) $this->createQueryBuilder('lsv')
            ->select('COUNT(lsv.id)')
            ->where('lsv.liveSession = :session')
            ->andWhere('lsv.isActive = :active')
            ->setParameter('session', $session)
            ->setParameter('active', true)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findForSessionAndViewer(LiveSession $session, User $viewer): ?LiveSessionViewer
    {
        return $this->findOneBy([
            'liveSession' => $session,
            'viewerUser' => $viewer,
        ]);
    }
}
