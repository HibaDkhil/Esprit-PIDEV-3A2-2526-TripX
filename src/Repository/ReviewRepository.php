<?php

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Review>
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    /**
     * Find all reviews for a destination, newest first.
     *
     * @return Review[]
     */
    public function findByDestination(int $destinationId): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.destinationId = :destId')
            ->setParameter('destId', $destinationId)
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Calculate the average rating for a destination.
     */
    public function getAverageRating(int $destinationId): ?float
    {
        $result = $this->createQueryBuilder('r')
            ->select('AVG(r.rating) as avgRating')
            ->andWhere('r.destinationId = :destId')
            ->setParameter('destId', $destinationId)
            ->getQuery()
            ->getSingleScalarResult();

        return $result !== null ? round((float) $result, 2) : null;
    }

    /**
     * Find all reviews by a specific user.
     *
     * @return Review[]
     */
    public function findByUser(int $userId): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.userId = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Check if a user already reviewed a destination.
     */
    public function findOneByUserAndDestination(int $userId, int $destinationId): ?Review
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.userId = :userId')
            ->andWhere('r.destinationId = :destId')
            ->setParameter('userId', $userId)
            ->setParameter('destId', $destinationId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Count reviews for a destination.
     */
    public function countByDestination(int $destinationId): int
    {
        return (int) $this->createQueryBuilder('r')
            ->select('COUNT(r.reviewId)')
            ->andWhere('r.destinationId = :destId')
            ->setParameter('destId', $destinationId)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Find all reviews (for admin listing).
     *
     * @return Review[]
     */
    public function findAllOrdered(): array
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
