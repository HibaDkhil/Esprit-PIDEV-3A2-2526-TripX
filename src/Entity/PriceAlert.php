<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'price_alerts')]
class PriceAlert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'user_id')]
    private int $userId;

    #[ORM\Column(name: 'activity_id', type: 'bigint')]
    private string $activityId;

    #[ORM\Column(name: 'target_price', type: 'decimal', precision: 10, scale: 2)]
    private string $targetPrice;

    #[ORM\Column(length: 4)]
    private string $direction;

    #[ORM\Column(name: 'is_active', type: 'boolean', options: ['default' => true])]
    private bool $isActive = true;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function getActivityId(): string
    {
        return $this->activityId;
    }

    public function setActivityId(string $activityId): static
    {
        $this->activityId = $activityId;

        return $this;
    }

    public function getTargetPrice(): string
    {
        return $this->targetPrice;
    }

    public function setTargetPrice(string $targetPrice): static
    {
        $this->targetPrice = $targetPrice;

        return $this;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function setDirection(string $direction): static
    {
        $this->direction = $direction;

        return $this;
    }

    public function isIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
}
