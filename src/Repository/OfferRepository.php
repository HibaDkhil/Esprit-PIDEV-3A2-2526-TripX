<?php

namespace App\Repository;

use App\Entity\Offer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class OfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }

    /** Return all active offers (isActive = true and within date range). */
    public function findActiveOffers(): array
    {
        $today = new \DateTime();
        return $this->createQueryBuilder('o')
            ->where('o.isActive = :active')
            ->andWhere('o.startDate <= :today')
            ->andWhere('o.endDate >= :today')
            ->setParameter('active', true)
            ->setParameter('today', $today)
            ->orderBy('o.discountValue', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
