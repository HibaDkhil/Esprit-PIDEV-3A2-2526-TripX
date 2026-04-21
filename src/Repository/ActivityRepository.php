<?php

namespace App\Repository;

use App\Entity\Activity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Activity>
 */
class ActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activity::class);
    }

    /**
     * Search activities by name or category.
     *
     * @return Activity[]
     */
    public function search(string $query = ''): array
    {
        $qb = $this->createQueryBuilder('a');

        if (!empty($query)) {
            $qb->where('a.name LIKE :query OR a.category LIKE :query')
               ->setParameter('query', '%' . $query . '%');
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Find activities by category.
     *
     * @return Activity[]
     */
    public function findByCategory(string $category): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.category = :category')
            ->setParameter('category', $category)
            ->orderBy('a.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find activities by destination ID.
     *
     * @return Activity[]
     */
    public function findByDestination(string $destinationId): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.destinationId = :destId')
            ->setParameter('destId', $destinationId)
            ->orderBy('a.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find activities within a price range.
     *
     * @return Activity[]
     */
    public function findByPriceRange(float $min, float $max): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.price BETWEEN :min AND :max')
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->orderBy('a.price', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
