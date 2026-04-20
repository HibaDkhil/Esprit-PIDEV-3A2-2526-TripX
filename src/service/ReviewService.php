<?php

namespace App\service;

use App\Entity\Destination;
use App\Entity\Review;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;

class ReviewService
{
    private EntityManagerInterface $em;
    private ReviewRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Review::class);
    }

    public function find(int $id): ?Review
    {
        return $this->repository->find($id);
    }

    /**
     * @return Review[]
     */
    public function getByDestination(int $destinationId): array
    {
        return $this->repository->findByDestination($destinationId);
    }

    /**
     * @return Review[]
     */
    public function getByUser(int $userId): array
    {
        return $this->repository->findByUser($userId);
    }

    /**
     * @return Review[]
     */
    public function getAll(): array
    {
        return $this->repository->findAllOrdered();
    }

    public function findByUserAndDestination(int $userId, int $destinationId): ?Review
    {
        return $this->repository->findOneByUserAndDestination($userId, $destinationId);
    }

    public function save(Review $review): void
    {
        $this->em->persist($review);
        $this->em->flush();
    }

    public function delete(int $id): bool
    {
        $review = $this->find($id);
        if ($review) {
            $this->em->remove($review);
            $this->em->flush();
            return true;
        }
        return false;
    }

    /**
     * Recalculate and update the average_rating on the Destination entity.
     */
    public function recalculateAverageRating(int $destinationId): void
    {
        $avg = $this->repository->getAverageRating($destinationId);
        $destination = $this->em->getRepository(Destination::class)->find($destinationId);

        if ($destination) {
            $destination->setAverageRating(number_format($avg ?? 0, 2, '.', ''));
            $this->em->flush();
        }
    }

    /**
     * Get the review count for a destination.
     */
    public function countByDestination(int $destinationId): int
    {
        return $this->repository->countByDestination($destinationId);
    }
}
