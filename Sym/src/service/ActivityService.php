<?php

namespace App\service;

use App\Entity\Activity;
use Doctrine\ORM\EntityManagerInterface;

class ActivityService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAll(string $query = ''): array
    {
        $qb = $this->em->createQueryBuilder()
            ->select('a')
            ->from(Activity::class, 'a');

        if (!empty($query)) {
            $qb->where('a.name LIKE :query OR a.category LIKE :query')
               ->setParameter('query', '%' . $query . '%');
        }

        return $qb->getQuery()->getResult();
    }

    public function find(int $id): ?Activity
    {
        return $this->em->getRepository(Activity::class)->find($id);
    }

    public function delete(int $id): bool
    {
        $activity = $this->find($id);
        if ($activity) {
            $this->em->remove($activity);
            $this->em->flush();
            return true;
        }
        return false;
    }

    public function save(Activity $activity): void
    {
        $this->em->persist($activity);
        $this->em->flush();
    }
}
