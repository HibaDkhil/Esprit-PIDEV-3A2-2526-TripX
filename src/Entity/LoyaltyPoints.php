<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'loyalty_points')]
class LoyaltyPoints
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'user_id', type: 'integer')]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?int $userId = null;

    #[ORM\Column(name: 'total_points', type: 'integer', options: ['default' => 0])]
    #[Assert\PositiveOrZero(message: 'Points cannot be negative.')]
    private int $totalPoints = 0;

    #[ORM\Column(type: 'string', length: 20, options: ['default' => 'BRONZE'])]
    #[Assert\Choice(choices: ['BRONZE', 'SILVER', 'GOLD'], message: 'Invalid loyalty level.')]
    private string $level = 'BRONZE';

    #[ORM\Column(name: 'created_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(name: 'updated_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int { return $this->id; }

    public function getUserId(): ?int { return $this->userId; }
    public function setUserId(int $userId): static { $this->userId = $userId; return $this; }

    public function getTotalPoints(): int { return $this->totalPoints; }
    public function setTotalPoints(int $totalPoints): static { $this->totalPoints = $totalPoints; return $this; }

    public function getLevel(): string { return $this->level; }
    public function setLevel(string $level): static { $this->level = $level; return $this; }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): static { $this->createdAt = $createdAt; return $this; }

    public function getUpdatedAt(): ?\DateTimeInterface { return $this->updatedAt; }
    public function setUpdatedAt(\DateTimeInterface $updatedAt): static { $this->updatedAt = $updatedAt; return $this; }

    public function computeLevel(): string
    {
        if ($this->totalPoints >= 400) return 'GOLD';
        if ($this->totalPoints >= 200) return 'SILVER';
        return 'BRONZE';
    }

    public function getLoyaltyDiscountPercent(): float
    {
        return match ($this->computeLevel()) {
            'GOLD'   => 15.0,
            'SILVER' => 9.0,
            default  => 4.0,
        };
    }

    public function getPointsToNextLevel(): int
    {
        return match ($this->computeLevel()) {
            'BRONZE' => 200 - $this->totalPoints,
            'SILVER' => 400 - $this->totalPoints,
            default  => 0,
        };
    }
}
