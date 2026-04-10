<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'offers')]
class Offer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_offer', type: 'integer')]
    private ?int $idOffer = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Title is required.')]
    #[Assert\Length(min: 3, max: 255, minMessage: 'Title must be at least 3 characters.', maxMessage: 'Title cannot exceed 255 characters.')]
    private ?string $title = null;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\Length(max: 2000, maxMessage: 'Description cannot exceed 2000 characters.')]
    private ?string $description = null;

    #[ORM\Column(name: 'discount_type', type: 'string', length: 20)]
    #[Assert\NotBlank(message: 'Discount type is required.')]
    #[Assert\Choice(choices: ['PERCENTAGE', 'FIXED'], message: 'Discount type must be PERCENTAGE or FIXED.')]
    private ?string $discountType = null;

    #[ORM\Column(name: 'discount_value', type: 'decimal', precision: 10, scale: 2)]
    #[Assert\NotBlank(message: 'Discount value is required.')]
    #[Assert\Positive(message: 'Discount value must be greater than zero.')]
    #[Assert\LessThanOrEqual(value: 100, message: 'Percentage discount cannot exceed 100%.')]
    private ?string $discountValue = null;

    #[ORM\Column(name: 'pack_id', type: 'integer', nullable: true)]
    private ?int $packId = null;

    #[ORM\Column(name: 'destination_id', type: 'bigint', nullable: true)]
    private ?string $destinationId = null;

    #[ORM\Column(name: 'accommodation_id', type: 'integer', nullable: true)]
    private ?int $accommodationId = null;

    #[ORM\Column(name: 'start_date', type: 'date')]
    #[Assert\NotBlank(message: 'Start date is required.')]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(name: 'end_date', type: 'date')]
    #[Assert\NotBlank(message: 'End date is required.')]
    #[Assert\Type(\DateTimeInterface::class)]
    #[Assert\GreaterThan(propertyPath: 'startDate', message: 'End date must be after start date.')]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column(name: 'is_active', type: 'boolean', options: ['default' => true])]
    private bool $isActive = true;

    public function getId(): ?int { return $this->idOffer; }
    public function getIdOffer(): ?int { return $this->idOffer; }

    public function getTitle(): ?string { return $this->title; }
    public function setTitle(string $title): static { $this->title = $title; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): static { $this->description = $description; return $this; }

    public function getDiscountType(): ?string { return $this->discountType; }
    public function setDiscountType(string $discountType): static { $this->discountType = $discountType; return $this; }

    public function getDiscountValue(): ?string { return $this->discountValue; }
    public function setDiscountValue(string $discountValue): static { $this->discountValue = $discountValue; return $this; }

    public function getPackId(): ?int { return $this->packId; }
    public function setPackId(?int $packId): static { $this->packId = $packId; return $this; }

    public function getDestinationId(): ?string { return $this->destinationId; }
    public function setDestinationId(?string $destinationId): static { $this->destinationId = $destinationId; return $this; }

    public function getAccommodationId(): ?int { return $this->accommodationId; }
    public function setAccommodationId(?int $accommodationId): static { $this->accommodationId = $accommodationId; return $this; }

    public function getStartDate(): ?\DateTimeInterface { return $this->startDate; }
    public function setStartDate(\DateTimeInterface $startDate): static { $this->startDate = $startDate; return $this; }

    public function getEndDate(): ?\DateTimeInterface { return $this->endDate; }
    public function setEndDate(\DateTimeInterface $endDate): static { $this->endDate = $endDate; return $this; }

    public function isActive(): bool { return $this->isActive; }
    public function setIsActive(bool $isActive): static { $this->isActive = $isActive; return $this; }

    public function isCurrentlyValid(): bool
    {
        $today = new \DateTime();
        return $this->isActive && $this->startDate <= $today && $this->endDate >= $today;
    }
}
