<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'packs_bookings')]
class PacksBooking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_booking', type: 'integer')]
    private ?int $idBooking = null;

    #[ORM\Column(name: 'user_id', type: 'integer')]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?int $userId = null;

    #[ORM\Column(name: 'pack_id', type: 'integer')]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?int $packId = null;

    #[ORM\Column(name: 'booking_date', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $bookingDate = null;

    #[ORM\Column(name: 'travel_start_date', type: 'date')]
    #[Assert\NotBlank(message: 'Travel start date is required.')]
    #[Assert\GreaterThanOrEqual('today', message: 'Start date cannot be in the past.')]
    private ?\DateTimeInterface $travelStartDate = null;

    #[ORM\Column(name: 'travel_end_date', type: 'date')]
    #[Assert\NotBlank(message: 'Travel end date is required.')]
    #[Assert\GreaterThan(propertyPath: 'travelStartDate', message: 'End date must be after start date.')]
    private ?\DateTimeInterface $travelEndDate = null;

    #[ORM\Column(name: 'num_travelers', type: 'integer')]
    #[Assert\NotBlank(message: 'Number of travelers is required.')]
    #[Assert\Range(min: 1, max: 20, notInRangeMessage: 'Travelers must be between 1 and 20.')]
    private int $numTravelers = 1;

    #[ORM\Column(name: 'total_price', type: 'decimal', precision: 10, scale: 2)]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    private ?string $totalPrice = null;

    #[ORM\Column(name: 'discount_applied', type: 'decimal', precision: 10, scale: 2, options: ['default' => '0.00'])]
    #[Assert\PositiveOrZero]
    private string $discountApplied = '0.00';

    #[ORM\Column(name: 'final_price', type: 'decimal', precision: 10, scale: 2)]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    private ?string $finalPrice = null;

    #[ORM\Column(type: 'string', length: 20, options: ['default' => 'PENDING'])]
    #[Assert\Choice(choices: ['PENDING', 'CONFIRMED', 'CANCELLED', 'COMPLETED'], message: 'Invalid booking status.')]
    private string $status = 'PENDING';

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\Length(max: 1000, maxMessage: 'Notes cannot exceed 1000 characters.')]
    private ?string $notes = null;

    #[ORM\Column(name: 'created_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(name: 'updated_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->bookingDate = new \DateTime();
        $this->createdAt   = new \DateTime();
        $this->updatedAt   = new \DateTime();
        $this->status      = 'PENDING';
    }

    public function getId(): ?int { return $this->idBooking; }
    public function getIdBooking(): ?int { return $this->idBooking; }

    public function getUserId(): ?int { return $this->userId; }
    public function setUserId(int $userId): static { $this->userId = $userId; return $this; }

    public function getPackId(): ?int { return $this->packId; }
    public function setPackId(int $packId): static { $this->packId = $packId; return $this; }

    public function getBookingDate(): ?\DateTimeInterface { return $this->bookingDate; }
    public function setBookingDate(\DateTimeInterface $bookingDate): static { $this->bookingDate = $bookingDate; return $this; }

    public function getTravelStartDate(): ?\DateTimeInterface { return $this->travelStartDate; }
    public function setTravelStartDate(\DateTimeInterface $travelStartDate): static { $this->travelStartDate = $travelStartDate; return $this; }

    public function getTravelEndDate(): ?\DateTimeInterface { return $this->travelEndDate; }
    public function setTravelEndDate(\DateTimeInterface $travelEndDate): static { $this->travelEndDate = $travelEndDate; return $this; }

    public function getNumTravelers(): int { return $this->numTravelers; }
    public function setNumTravelers(int $numTravelers): static { $this->numTravelers = $numTravelers; return $this; }

    public function getTotalPrice(): ?string { return $this->totalPrice; }
    public function setTotalPrice(string $totalPrice): static { $this->totalPrice = $totalPrice; return $this; }

    public function getDiscountApplied(): string { return $this->discountApplied; }
    public function setDiscountApplied(string $discountApplied): static { $this->discountApplied = $discountApplied; return $this; }

    public function getFinalPrice(): ?string { return $this->finalPrice; }
    public function setFinalPrice(string $finalPrice): static { $this->finalPrice = $finalPrice; return $this; }

    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): static { $this->status = $status; return $this; }

    public function getNotes(): ?string { return $this->notes; }
    public function setNotes(?string $notes): static { $this->notes = $notes; return $this; }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): static { $this->createdAt = $createdAt; return $this; }

    public function getUpdatedAt(): ?\DateTimeInterface { return $this->updatedAt; }
    public function setUpdatedAt(\DateTimeInterface $updatedAt): static { $this->updatedAt = $updatedAt; return $this; }
}
