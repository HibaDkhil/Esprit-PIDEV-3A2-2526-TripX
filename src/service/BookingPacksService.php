<?php

namespace App\service;

use App\Entity\PacksBooking;
use Doctrine\ORM\EntityManagerInterface;

class BookingPacksService
{
    public function __construct(private EntityManagerInterface $em) {}

    public function getAll(): array
    {
        return $this->em->createQueryBuilder()
            ->select('b')
            ->from(PacksBooking::class, 'b')
            ->orderBy('b.bookingDate', 'DESC')
            ->getQuery()->getResult();
    }

    public function getByUserId(int $userId): array
    {
        return $this->em->createQueryBuilder()
            ->select('b')
            ->from(PacksBooking::class, 'b')
            ->where('b.userId = :uid')
            ->setParameter('uid', $userId)
            ->orderBy('b.bookingDate', 'DESC')
            ->getQuery()->getResult();
    }

    public function find(int $id): ?PacksBooking
    {
        return $this->em->getRepository(PacksBooking::class)->find($id);
    }

    public function save(PacksBooking $booking): void
    {
        $this->em->persist($booking);
        $this->em->flush();
    }

    public function updateStatus(int $id, string $status): bool
    {
        $booking = $this->find($id);
        if ($booking) {
            $booking->setStatus($status);
            $booking->setUpdatedAt(new \DateTime());
            $this->em->flush();
            return true;
        }
        return false;
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

    public function getStats(): array
    {
        $all = $this->getAll();
        $byStatus = [];
        foreach ($all as $b) {
            $byStatus[$b->getStatus()] = ($byStatus[$b->getStatus()] ?? 0) + 1;
        }
        return [
            'total'     => count($all),
            'pending'   => $byStatus['PENDING']   ?? 0,
            'confirmed' => $byStatus['CONFIRMED']  ?? 0,
            'cancelled' => $byStatus['CANCELLED']  ?? 0,
            'completed' => $byStatus['COMPLETED']  ?? 0,
        ];
    }
}
