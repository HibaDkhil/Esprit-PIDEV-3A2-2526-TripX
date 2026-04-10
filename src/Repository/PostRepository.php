<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * Confirmed posts only, newest first, with optional search + type filter.
     * Eager-load comments so feed comments show immediately.
     */
    public function findFiltered(string $search = '', string $type = ''): array
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.comments', 'c')
            ->addSelect('c')
            ->where('p.is_confirmed = :confirmed')
            ->setParameter('confirmed', true)
            ->orderBy('p.id', 'DESC')
            ->addOrderBy('c.created_at', 'ASC');

        if ($search !== '') {
            $qb->andWhere('p.title LIKE :s OR p.body LIKE :s')
               ->setParameter('s', '%' . $search . '%');
        }

        if ($type !== '') {
            $qb->andWhere('p.type = :type')
               ->setParameter('type', $type);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Feed query used by the mixed blog feed and AJAX filtering.
     * Keeps the same logic as findFiltered() so existing behavior is preserved.
     */
    public function searchFeed(string $search = '', string $type = ''): array
    {
        return $this->findFiltered($search, $type);
    }

    public function findByUser(int $userId): array
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.comments', 'c')
            ->addSelect('c')
            ->where('p.user_id = :uid')
            ->setParameter('uid', $userId)
            ->orderBy('p.created_at', 'DESC')
            ->addOrderBy('c.created_at', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function countPending(): int
    {
        return (int) $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->where('p.is_confirmed = :c OR p.is_confirmed IS NULL')
            ->setParameter('c', false)
            ->getQuery()
            ->getSingleScalarResult();
    }
}