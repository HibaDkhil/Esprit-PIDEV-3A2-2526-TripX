<?php

namespace App\Repository;

use App\Entity\Destination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Destination>
 */
class DestinationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Destination::class);
    }

    /**
     * Search destinations by name, country, or type.
     *
     * @return Destination[]
     */
    public function search(string $query = ''): array
    {
        $qb = $this->createQueryBuilder('d');

        if (!empty($query)) {
            $qb->where('d.name LIKE :query OR d.country LIKE :query OR d.type LIKE :query')
               ->setParameter('query', '%' . $query . '%');
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Find destinations by type.
     *
     * @return Destination[]
     */
    public function findByType(string $type): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.type = :type')
            ->setParameter('type', $type)
            ->orderBy('d.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find destinations by country.
     *
     * @return Destination[]
     */
    public function findByCountry(string $country): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.country = :country')
            ->setParameter('country', $country)
            ->orderBy('d.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find destinations by season.
     *
     * @return Destination[]
     */
    public function findBySeason(string $season): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.bestSeason = :season')
            ->setParameter('season', $season)
            ->orderBy('d.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find destinations within a budget range.
     *
     * @return Destination[]
     */
    public function findByBudgetRange(float $min, float $max): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.estimatedBudget BETWEEN :min AND :max')
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->orderBy('d.estimatedBudget', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
