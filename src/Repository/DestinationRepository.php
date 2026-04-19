<?php

namespace App\Repository;

use App\Entity\Destination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
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
     * Return a Query object for paginated destination search.
     */
    public function searchQuery(string $query = ''): Query
    {
        $qb = $this->createQueryBuilder('d');

        if (!empty($query)) {
            $qb->where('d.name LIKE :query OR d.country LIKE :query OR d.type LIKE :query')
               ->setParameter('query', '%' . $query . '%');
        }

        return $qb->getQuery();
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

    /**
     * Pre-filter destinations by user preference criteria.
     * Applies optional WHERE clauses so the scoring algorithm
     * works on a narrower result set.
     *
     * @param array $filters  Accepted keys:
     *   - season:    string|null
     *   - type:      string|null
     *   - minRating: float|null
     *   - maxBudget: float|null
     *   - minBudget: float|null
     *
     * @return Destination[]
     */
    public function findByPreferenceFilters(array $filters): array
    {
        $qb = $this->createQueryBuilder('d');

        if (!empty($filters['season'])) {
            $qb->andWhere('d.bestSeason = :season OR d.bestSeason = :allYear')
               ->setParameter('season', $filters['season'])
               ->setParameter('allYear', 'all_year');
        }

        if (!empty($filters['type'])) {
            $qb->andWhere('d.type = :type')
               ->setParameter('type', $filters['type']);
        }

        if (!empty($filters['minRating'])) {
            $qb->andWhere('d.averageRating >= :minRating')
               ->setParameter('minRating', (float) $filters['minRating']);
        }

        if (!empty($filters['maxBudget'])) {
            $qb->andWhere('d.estimatedBudget <= :maxBudget OR d.estimatedBudget IS NULL')
               ->setParameter('maxBudget', (float) $filters['maxBudget']);
        }

        if (!empty($filters['minBudget'])) {
            $qb->andWhere('d.estimatedBudget >= :minBudget')
               ->setParameter('minBudget', (float) $filters['minBudget']);
        }

        return $qb->orderBy('d.averageRating', 'DESC')
                   ->getQuery()
                   ->getResult();
    }
}
