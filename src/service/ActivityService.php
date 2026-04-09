<?php

namespace App\service;

use App\Entity\Activity;
use App\Repository\ActivityRepository;
use Doctrine\ORM\EntityManagerInterface;

class ActivityService
{
    private EntityManagerInterface $em;
    private ActivityRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Activity::class);
    }

    public function getAll(string $query = ''): array
    {
        return $this->repository->search($query);
    }

    public function find(int $id): ?Activity
    {
        return $this->repository->find($id);
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
