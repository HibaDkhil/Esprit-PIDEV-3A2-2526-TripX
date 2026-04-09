<?php

namespace App\Repository;

use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Booking>
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    /**
     * Search bookings by reference, email, or status.
     *
     * @return Booking[]
     */
    public function search(string $query = ''): array
    {
        $qb = $this->createQueryBuilder('b')
            ->orderBy('b.createdAt', 'DESC');

        if (!empty($query)) {
            $qb->where('b.bookingReference LIKE :query OR b.userEmail LIKE :query OR b.status LIKE :query')
               ->setParameter('query', '%' . $query . '%');
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Find bookings belonging to a specific user.
     *
     * @return Booking[]
     */
    public function findByUser(int $userId): array
    {
        return $this->createQueryBuilder('b')
            ->where('b.userId = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('b.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find bookings by status.
     *
     * @return Booking[]
     */
    public function findByStatus(string $status): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.status = :status')
            ->setParameter('status', $status)
            ->orderBy('b.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find bookings by destination ID.
     *
     * @return Booking[]
     */
    public function findByDestination(string $destinationId): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.destinationId = :destId')
            ->setParameter('destId', $destinationId)
            ->orderBy('b.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
