<?php
namespace App\service;

use App\Entity\Transport;
use App\Repository\TransportRepository;
use Doctrine\ORM\EntityManagerInterface;

class TransportService
{
    private EntityManagerInterface $entityManager;
    private TransportRepository $repository;

    public function __construct(EntityManagerInterface $entityManager, TransportRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    // Create
    public function addTransport(Transport $t): void
    {
        $this->entityManager->persist($t);
        $this->entityManager->flush();
    }

    // Read all
    public function getAllTransports(): array
    {
        return $this->repository->findAll();
    }

    // Update
    public function updateTransport(Transport $t): void
    {
        $this->entityManager->flush();
    }

    // Delete
    public function deleteTransport(int $id): void
    {
        $transport = $this->repository->find($id);
        if ($transport) {
            $this->entityManager->remove($transport);
            $this->entityManager->flush();
        }
    }

    // Get by transport type (FLIGHT or VEHICLE)
    public function getTransportsByType(string $type): array
    {
        return $this->repository->findBy(['transportType' => $type]);
    }

    // Get only active transports
    public function getActiveTransports(): array
    {
        return $this->repository->findBy(['isActive' => true]);
    }
    public function findById(int $id): ?Transport
{
    return $this->repository->find($id);
}
}