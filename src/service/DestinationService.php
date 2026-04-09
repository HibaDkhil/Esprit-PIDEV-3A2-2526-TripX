<?php

namespace App\service;

use App\Entity\Destination;
use App\Repository\DestinationRepository;
use Doctrine\ORM\EntityManagerInterface;

class DestinationService
{
    private EntityManagerInterface $em;
    private DestinationRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Destination::class);
    }

    public function getAll(string $query = ''): array
    {
        return $this->repository->search($query);
    }

    public function find(string $id): ?Destination
    {
        return $this->repository->find($id);
    }

    public function delete(string $id): bool
    {
        $dest = $this->find($id);
        if ($dest) {
            $this->em->remove($dest);
            $this->em->flush();
            return true;
        }
        return false;
    }

    public function save(Destination $destination): void
    {
        $this->em->persist($destination);
        $this->em->flush();
    }
}
