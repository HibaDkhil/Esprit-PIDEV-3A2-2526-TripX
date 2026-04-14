<?php

namespace App\Repository;

use App\Entity\BlogProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BlogProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogProfile::class);
    }

    public function findOneByUserId(int $userId): ?BlogProfile
    {
        return $this->createQueryBuilder('bp')
            ->leftJoin('bp.user', 'u')
            ->addSelect('u')
            ->where('u.userId = :uid')
            ->setParameter('uid', $userId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
