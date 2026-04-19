<?php

namespace App\service;

use App\Entity\DestinationTrans;
use App\Repository\DestinationTransRepository;
use Doctrine\ORM\EntityManagerInterface;

class DestinationTransService
{
    private EntityManagerInterface $entityManager;
    private DestinationTransRepository $repository;

    public function __construct(EntityManagerInterface $entityManager, DestinationTransRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository    = $repository;
    }

    public function addDestination(DestinationTrans $d): void
    {
        $this->entityManager->persist($d);
        $this->entityManager->flush();
    }

    public function getAllDestinations(): array
    {
        return $this->repository->findBy([], ['name' => 'ASC']);
    }

    public function findById(int $id): ?DestinationTrans
    {
        return $this->repository->find($id);
    }

    public function updateDestination(DestinationTrans $d): void
    {
        $this->entityManager->flush();
    }

    public function deleteDestination(int $id): void
    {
        $d = $this->findById($id);
        if ($d) {
            $this->entityManager->remove($d);
            $this->entityManager->flush();
        }
    }
}
