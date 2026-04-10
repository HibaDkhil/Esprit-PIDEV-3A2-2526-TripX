<?php

namespace App\Repository;

use App\Entity\Accommodation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Accommodation>
 */
class AccommodationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Accommodation::class);
    }

    public function findByFilters(string $search = '', string $type = '', string $status = ''): array
    {
        $qb = $this->createQueryBuilder('a')->orderBy('a.createdAt', 'DESC');

        if ($search) {
            $qb->andWhere('a.name LIKE :search OR a.city LIKE :search OR a.country LIKE :search')
               ->setParameter('search', "%$search%");
        }
        if ($type) {
            $qb->andWhere('a.type = :type')->setParameter('type', $type);
        }
        if ($status) {
            $qb->andWhere('a.status = :status')->setParameter('status', $status);
        }

        return $qb->getQuery()->getResult();
    }

    public function findDistinctTypes(): array
    {
        return $this->createQueryBuilder('a')
            ->select('DISTINCT a.type')
            ->where('a.type IS NOT NULL')
            ->getQuery()
            ->getSingleColumnResult();
    }

    public function getStats(): array
    {
        $total    = $this->count([]);
        $active   = $this->count(['status' => 'Active']);
        $inactive = $total - $active;

        return ['total' => $total, 'active' => $active, 'inactive' => $inactive];
    }
}