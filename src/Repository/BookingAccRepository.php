<?php

namespace App\Repository;

use App\Entity\BookingAcc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BookingAcc>
 */
class BookingAccRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookingAcc::class);
    }

    /**
     * Build the base query for bookings with joins
     */
    private function createFilteredQueryBuilder(
        ?string $status = null,
        ?string $search = null,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?int $accommodationId = null
    ): QueryBuilder {
        $qb = $this->createQueryBuilder('b')
            ->leftJoin('b.room', 'r')
            ->leftJoin('r.accommodation', 'a')
            ->addSelect('r', 'a');

        if ($status) {
            $qb->andWhere('b.status = :status')
               ->setParameter('status', $status);
        }

        if ($search) {
            $qb->andWhere('b.phoneNumber LIKE :search OR a.name LIKE :search OR r.roomName LIKE :search')
               ->setParameter('search', "%$search%");
        }

        if ($dateFrom) {
            $qb->andWhere('b.checkIn >= :dateFrom')
               ->setParameter('dateFrom', new \DateTime($dateFrom));
        }

        if ($dateTo) {
            $qb->andWhere('b.checkOut <= :dateTo')
               ->setParameter('dateTo', new \DateTime($dateTo));
        }

        if ($accommodationId) {
            $qb->andWhere('a.id = :accommodationId')
               ->setParameter('accommodationId', $accommodationId);
        }

        return $qb;
    }

    /**
     * Find bookings with filters (for search/listing)
     *
     * @return BookingAcc[]
     */
    public function findFilteredBookings(
        ?string $status = null,
        ?string $search = null,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?int $accommodationId = null
    ): array {
        return $this->createFilteredQueryBuilder($status, $search, $dateFrom, $dateTo, $accommodationId)
            ->orderBy('b.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Count filtered bookings (for stats/export)
     */
    public function countFilteredBookings(
        ?string $status = null,
        ?string $search = null,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?int $accommodationId = null
    ): int {
        $qb = $this->createFilteredQueryBuilder($status, $search, $dateFrom, $dateTo, $accommodationId);
        
        // Modify for count (remove joins that might cause duplicates)
        $qb->select('COUNT(DISTINCT b.id)');
        
        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Get revenue for confirmed bookings with filters
     */
    public function getFilteredRevenue(
        ?string $status = null,
        ?string $search = null,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?int $accommodationId = null
    ): float {
        $qb = $this->createFilteredQueryBuilder($status, $search, $dateFrom, $dateTo, $accommodationId);
        
        $qb->select('SUM(b.totalPrice)')
           ->andWhere('b.status = :confirmedStatus')
           ->setParameter('confirmedStatus', 'CONFIRMED');
        
        return (float) ($qb->getQuery()->getSingleScalarResult() ?? 0);
    }

    /**
     * Get accommodation performance stats
     *
     * @return array<string, array{bookings: int, revenue: float}>
     */
    public function getAccommodationPerformance(
        ?string $status = null,
        ?string $search = null,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?int $accommodationId = null
    ): array {
        $qb = $this->createFilteredQueryBuilder($status, $search, $dateFrom, $dateTo, $accommodationId);
        
        $qb->select('a.name AS accName')
           ->addSelect('COUNT(b.id) AS totalBookings')
           ->addSelect('SUM(CASE WHEN b.status = :confirmed THEN b.totalPrice ELSE 0 END) AS revenue')
           ->setParameter('confirmed', 'CONFIRMED')
           ->groupBy('a.id');
        
        $results = $qb->getQuery()->getResult();
        
        $performance = [];
        foreach ($results as $row) {
            $performance[$row['accName']] = [
                'bookings' => (int) $row['totalBookings'],
                'revenue' => (float) $row['revenue'],
            ];
        }
        
        return $performance;
    }

    /**
     * Get monthly booking trends
     *
     * @return array<string, array{total: int, confirmed: int, revenue: float}>
     */
    public function getMonthlyTrends(
        ?string $status = null,
        ?string $search = null,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?int $accommodationId = null
    ): array {
        $qb = $this->createQueryBuilder('b')
            ->leftJoin('b.room', 'r')
            ->leftJoin('r.accommodation', 'a')
            ->select('DATE_FORMAT(b.createdAt, \'%Y-%m\') AS month')
            ->addSelect('COUNT(b.id) AS totalBookings')
            ->addSelect('SUM(CASE WHEN b.status = :confirmed THEN b.totalPrice ELSE 0 END) AS revenue')
            ->setParameter('confirmed', 'CONFIRMED')
            ->groupBy('month')
            ->orderBy('month', 'DESC');

        if ($status) {
            $qb->andWhere('b.status = :status')->setParameter('status', $status);
        }
        if ($search) {
            $qb->andWhere('b.phoneNumber LIKE :search OR a.name LIKE :search OR r.roomName LIKE :search')
               ->setParameter('search', "%$search%");
        }
        if ($dateFrom) {
            $qb->andWhere('b.checkIn >= :dateFrom')->setParameter('dateFrom', new \DateTime($dateFrom));
        }
        if ($dateTo) {
            $qb->andWhere('b.checkOut <= :dateTo')->setParameter('dateTo', new \DateTime($dateTo));
        }
        if ($accommodationId) {
            $qb->andWhere('a.id = :accommodationId')->setParameter('accommodationId', $accommodationId);
        }

        $results = $qb->getQuery()->getResult();
        
        $trends = [];
        foreach ($results as $row) {
            $trends[$row['month']] = [
                'total' => (int) $row['totalBookings'],
                'revenue' => (float) $row['revenue'],
            ];
        }
        
        return $trends;
    }

    /**
     * Get room type performance
     *
     * @return array<string, array{bookings: int, revenue: float}>
     */
    public function getRoomTypePerformance(
        ?string $status = null,
        ?string $search = null,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?int $accommodationId = null
    ): array {
        $qb = $this->createQueryBuilder('b')
            ->leftJoin('b.room', 'r')
            ->leftJoin('r.accommodation', 'a')
            ->select('r.roomType AS roomType')
            ->addSelect('COUNT(b.id) AS totalBookings')
            ->addSelect('SUM(CASE WHEN b.status = :confirmed THEN b.totalPrice ELSE 0 END) AS revenue')
            ->setParameter('confirmed', 'CONFIRMED')
            ->groupBy('r.roomType');

        if ($status) {
            $qb->andWhere('b.status = :status')->setParameter('status', $status);
        }
        if ($search) {
            $qb->andWhere('b.phoneNumber LIKE :search OR a.name LIKE :search OR r.roomName LIKE :search')
               ->setParameter('search', "%$search%");
        }
        if ($dateFrom) {
            $qb->andWhere('b.checkIn >= :dateFrom')->setParameter('dateFrom', new \DateTime($dateFrom));
        }
        if ($dateTo) {
            $qb->andWhere('b.checkOut <= :dateTo')->setParameter('dateTo', new \DateTime($dateTo));
        }
        if ($accommodationId) {
            $qb->andWhere('a.id = :accommodationId')->setParameter('accommodationId', $accommodationId);
        }

        $results = $qb->getQuery()->getResult();
        
        $performance = [];
        foreach ($results as $row) {
            $performance[$row['roomType'] ?? 'Standard'] = [
                'bookings' => (int) $row['totalBookings'],
                'revenue' => (float) $row['revenue'],
            ];
        }
        
        return $performance;
    }
}