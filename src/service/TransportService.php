<?php
namespace App\service;

use App\Entity\Transport;
use App\Repository\TransportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class TransportService
{
    private EntityManagerInterface $entityManager;
    private TransportRepository $repository;
    private CacheInterface $cache;

    public function __construct(EntityManagerInterface $entityManager, TransportRepository $repository, CacheInterface $cache)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->cache = $cache;
    }

    // Create
    public function addTransport(Transport $t): void
    {
        $this->entityManager->persist($t);
        $this->entityManager->flush();
        $this->cache->delete('transports_all');
    }

    // Read all
    public function getAllTransports(bool &$fromCache = null): array
    {
        $hit = true;
        $data = $this->cache->get('transports_all', function (ItemInterface $item) use (&$hit) {
            $hit = false;
            $item->expiresAfter(600);
            return $this->repository->findAll();
        });
        if ($fromCache !== null) {
            $fromCache = $hit;
        }
        return $data;
    }

    // Update
    public function updateTransport(Transport $t): void
    {
        $this->entityManager->flush();
        $this->cache->delete('transports_all');
    }

    // Delete
    public function deleteTransport(int $id): void
    {
        $transport = $this->repository->find($id);
        if ($transport) {
            $this->entityManager->remove($transport);
            $this->entityManager->flush();
            $this->cache->delete('transports_all');
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