<?php

namespace App\service;

use App\Entity\LoyaltyPoints;
use Doctrine\ORM\EntityManagerInterface;

class LoyaltyService
{
    private const POINTS_PER_TRIP = 50;

    public function __construct(private EntityManagerInterface $em) {}

    public function getAll(): array
    {
        return $this->em->getRepository(LoyaltyPoints::class)->findAll();
    }

    public function getByUserId(int $userId): ?LoyaltyPoints
    {
        return $this->em->getRepository(LoyaltyPoints::class)
            ->findOneBy(['userId' => $userId]);
    }

    public function getOrCreate(int $userId): LoyaltyPoints
    {
        $lp = $this->getByUserId($userId);
        if (!$lp) {
            $lp = new LoyaltyPoints();
            $lp->setUserId($userId);
            $lp->setTotalPoints(0);
            $lp->setLevel('BRONZE');
            $this->em->persist($lp);
            $this->em->flush();
        }
        return $lp;
    }

    public function addTripPoints(int $userId): void
    {
        $lp = $this->getOrCreate($userId);
        $lp->setTotalPoints($lp->getTotalPoints() + self::POINTS_PER_TRIP);
        $lp->setLevel($lp->computeLevel());
        $lp->setUpdatedAt(new \DateTime());
        $this->em->flush();
    }

    public function calculateFinalPrice(float $basePrice, int $userId, float $offerDiscountPercent = 0): float
    {
        $lp = $this->getByUserId($userId);
        $loyaltyDiscount = $lp ? $lp->getLoyaltyDiscountPercent() : 0;
        $total = $offerDiscountPercent + $loyaltyDiscount;
        return max($basePrice - ($basePrice * $total / 100), 0);
    }

    public function save(LoyaltyPoints $lp): void
    {
        $this->em->persist($lp);
        $this->em->flush();
    }
}
