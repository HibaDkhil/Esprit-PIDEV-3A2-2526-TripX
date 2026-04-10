<?php

namespace App\service;

use App\Entity\Booking;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;

class BookingService
{
    private EntityManagerInterface $em;
    private BookingRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Booking::class);
    }

    public function getAll(string $query = ''): array
    {
        return $this->repository->search($query);
    }

    public function getByUser(int $userId): array
    {
        return $this->repository->findByUser($userId);
    }

    public function find(int $id): ?Booking
    {
        return $this->repository->find($id);
    }

    public function save(Booking $booking): void
    {
        $this->em->persist($booking);
        $this->em->flush();
    }

    public function delete(int $id): bool
    {
        $booking = $this->find($id);
        if ($booking) {
            $this->em->remove($booking);
            $this->em->flush();
            return true;
        }
        return false;
    }
}
