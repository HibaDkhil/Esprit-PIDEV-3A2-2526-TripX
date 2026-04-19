<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'packs')]
class Pack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_pack', type: 'integer')]
    private ?int $idPack = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Title is required.')]
    #[Assert\Length(min: 3, max: 255, minMessage: 'Title must be at least 3 characters.', maxMessage: 'Title cannot exceed 255 characters.')]
    private ?string $title = null;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\Length(max: 2000, maxMessage: 'Description cannot exceed 2000 characters.')]
    private ?string $description = null;

    #[ORM\Column(name: 'destination_id', type: 'bigint', nullable: true)]
    private ?string $destinationId = null;

    #[ORM\Column(name: 'accommodation_id', type: 'integer', nullable: true)]
    private ?int $accommodationId = null;

    #[ORM\Column(name: 'activity_id', type: 'bigint', nullable: true)]
    private ?string $activityId = null;

    #[ORM\Column(name: 'transport_id', type: 'integer', nullable: true)]
    private ?int $transportId = null;

    #[ORM\Column(name: 'category_id', type: 'integer', nullable: true)]
    private ?int $categoryId = null;

    #[ORM\Column(name: 'duration_days', type: 'integer')]
    #[Assert\NotBlank(message: 'Duration is required.')]
    #[Assert\Positive(message: 'Duration must be a positive number.')]
    #[Assert\LessThanOrEqual(value: 365, message: 'Duration cannot exceed 365 days.')]
    private ?int $durationDays = null;

    #[ORM\Column(name: 'base_price', type: 'decimal', precision: 10, scale: 2)]
    #[Assert\NotBlank(message: 'Base price is required.')]
    #[Assert\Positive(message: 'Price must be greater than zero.')]
    #[Assert\LessThanOrEqual(value: 99999.99, message: 'Price cannot exceed 99,999.99.')]
    private ?string $basePrice = null;

    #[ORM\Column(type: 'string', length: 20, options: ['default' => 'ACTIVE'])]
    #[Assert\NotBlank]
    #[Assert\Choice(choices: ['ACTIVE', 'INACTIVE'], message: 'Status must be ACTIVE or INACTIVE.')]
    private string $status = 'ACTIVE';

    #[ORM\Column(name: 'created_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->status    = 'ACTIVE';
    }

    public function getId(): ?int { return $this->idPack; }
    public function getIdPack(): ?int { return $this->idPack; }

    public function getTitle(): ?string { return $this->title; }
    public function setTitle(string $title): static { $this->title = $title; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): static { $this->description = $description; return $this; }

    public function getDestinationId(): ?string { return $this->destinationId; }
    public function setDestinationId(?string $destinationId): static { $this->destinationId = $destinationId; return $this; }

    public function getAccommodationId(): ?int { return $this->accommodationId; }
    public function setAccommodationId(?int $accommodationId): static { $this->accommodationId = $accommodationId; return $this; }

    public function getActivityId(): ?string { return $this->activityId; }
    public function setActivityId(?string $activityId): static { $this->activityId = $activityId; return $this; }

    public function getTransportId(): ?int { return $this->transportId; }
    public function setTransportId(?int $transportId): static { $this->transportId = $transportId; return $this; }

    public function getCategoryId(): ?int { return $this->categoryId; }
    public function setCategoryId(?int $categoryId): static { $this->categoryId = $categoryId; return $this; }

    public function getDurationDays(): ?int { return $this->durationDays; }
    public function setDurationDays(int $durationDays): static { $this->durationDays = $durationDays; return $this; }

    public function getBasePrice(): ?string { return $this->basePrice; }
    public function setBasePrice(string $basePrice): static { $this->basePrice = $basePrice; return $this; }

    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): static { $this->status = $status; return $this; }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): static { $this->createdAt = $createdAt; return $this; }
}
