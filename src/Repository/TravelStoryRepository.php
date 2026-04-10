<?php

namespace App\Repository;

use App\Entity\TravelStory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TravelStoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TravelStory::class);
    }

    public function findLatest(): array
    {
        return $this->createQueryBuilder('ts')
            ->orderBy('ts.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * DQL-based filter used by the unified blog feed.
     */
    public function findFiltered(
        string $search = '',
        string $destination = '',
        string $travelType = '',
        string $travelStyle = '',
        ?int   $rating = null
    ): array {
        $qb = $this->createQueryBuilder('ts')
            ->orderBy('ts.createdAt', 'DESC');

        if ($search !== '') {
            $qb->andWhere('ts.title LIKE :s OR ts.summary LIKE :s OR ts.destination LIKE :s')
               ->setParameter('s', '%' . $search . '%');
        }

        if ($destination !== '') {
            $qb->andWhere('ts.destination LIKE :dest')
               ->setParameter('dest', '%' . $destination . '%');
        }

        if ($travelType !== '') {
            $qb->andWhere('ts.travelType = :travelType')
               ->setParameter('travelType', $travelType);
        }

        if ($travelStyle !== '') {
            $qb->andWhere('ts.travelStyle = :travelStyle')
               ->setParameter('travelStyle', $travelStyle);
        }

        if ($rating !== null) {
            $qb->andWhere('ts.overallRating >= :rating')
               ->setParameter('rating', $rating);
        }

        return $qb->getQuery()->getResult();
    }

    public function searchByKeyword(?string $keyword): array
    {
        $qb = $this->createQueryBuilder('ts')
            ->orderBy('ts.createdAt', 'DESC');

        if ($keyword && trim($keyword) !== '') {
            $qb->andWhere('ts.title LIKE :kw OR ts.summary LIKE :kw OR ts.destination LIKE :kw')
               ->setParameter('kw', '%' . trim($keyword) . '%');
        }

        return $qb->getQuery()->getResult();
    }

    public function filterStories(?string $destination, ?string $travelType, ?string $travelStyle, ?int $rating): array
    {
        return $this->findFiltered('', $destination ?? '', $travelType ?? '', $travelStyle ?? '', $rating);
    }
}
