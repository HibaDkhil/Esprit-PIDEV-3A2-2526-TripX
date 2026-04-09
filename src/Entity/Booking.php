<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\BookingRepository;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
#[ORM\Table(name: 'bookingdes')]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'booking_id', type: 'bigint')]
    private ?string $bookingId = null;

    #[ORM\Column(name: 'booking_reference', type: 'string', length: 36)]
    private ?string $bookingReference = null;

    #[ORM\Column(name: 'user_id', type: 'integer', nullable: true)]
    private ?int $userId = null;

    #[ORM\Column(name: 'destination_id', type: 'bigint', nullable: true)]
    private ?string $destinationId = null;

    #[ORM\Column(name: 'activity_id', type: 'bigint', nullable: true)]
    private ?string $activityId = null;

    #[ORM\Column(name: 'start_at', type: 'datetime')]
    #[Assert\NotBlank(message: 'Start date is required.')]
    #[Assert\Type('\DateTimeInterface')]
    #[Assert\GreaterThanOrEqual(value: 'today', message: 'Start date cannot be in the past.')]
    private ?\DateTimeInterface $startAt = null;

    #[ORM\Column(name: 'end_at', type: 'datetime', nullable: true)]
    #[Assert\NotBlank(message: 'End date is required.')]
    #[Assert\Type('\DateTimeInterface')]
    #[Assert\GreaterThan(propertyPath: 'startAt', message: 'End date must be after start date.')]
    private ?\DateTimeInterface $endAt = null;

    #[ORM\Column(name: 'num_guests', type: 'smallint', options: ['default' => 1])]
    #[Assert\NotBlank(message: 'Number of guests is required.')]
    #[Assert\Range(min: 1, max: 20, notInRangeMessage: 'Number of guests must be between {{ min }} and {{ max }}.')]
    private ?int $numGuests = 1;

    #[ORM\Column(type: 'string', length: 20, options: ['default' => 'pending'])]
    #[Assert\Choice(choices: ['pending', 'confirmed', 'cancelled'], message: 'Invalid booking status.')]
    private string $status = 'pending';

    #[ORM\Column(name: 'payment_status', type: 'string', length: 20, options: ['default' => 'unpaid'])]
    #[Assert\Choice(choices: ['unpaid', 'paid', 'refunded'], message: 'Invalid payment status.')]
    private string $paymentStatus = 'unpaid';

    #[ORM\Column(name: 'total_amount', type: 'decimal', precision: 10, scale: 2, options: ['default' => '0.00'])]
    #[Assert\PositiveOrZero(message: 'Total amount must be 0 or positive.')]
    private ?string $totalAmount = '0.00';

    #[ORM\Column(type: 'string', length: 3, options: ['default' => 'USD'])]
    private string $currency = 'USD';

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $notes = null;

    #[ORM\Column(name: 'created_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(name: 'user_email', type: 'string', length: 255, nullable: true)]
    #[Assert\Email(message: 'The email {{ value }} is not a valid email.')]
    private ?string $userEmail = null;

    public function __construct()
    {
        $this->bookingReference = $this->generateReference();
        $this->createdAt = new \DateTime();
    }

    private function generateReference(): string
    {
        return strtoupper(substr(bin2hex(random_bytes(4)), 0, 8)) . '-' . date('Ymd');
    }

    public function getBookingId(): ?string { return $this->bookingId; }
    public function getId(): ?string { return $this->bookingId; }

    public function getBookingReference(): ?string { return $this->bookingReference; }
    public function setBookingReference(string $bookingReference): static { $this->bookingReference = $bookingReference; return $this; }

    public function getUserId(): ?int { return $this->userId; }
    public function setUserId(?int $userId): static { $this->userId = $userId; return $this; }

    public function getDestinationId(): ?string { return $this->destinationId; }
    public function setDestinationId(?string $destinationId): static { $this->destinationId = $destinationId; return $this; }

    public function getActivityId(): ?string { return $this->activityId; }
    public function setActivityId(?string $activityId): static { $this->activityId = $activityId; return $this; }

    public function getStartAt(): ?\DateTimeInterface { return $this->startAt; }
    public function setStartAt(?\DateTimeInterface $startAt): static { $this->startAt = $startAt; return $this; }

    public function getEndAt(): ?\DateTimeInterface { return $this->endAt; }
    public function setEndAt(?\DateTimeInterface $endAt): static { $this->endAt = $endAt; return $this; }

    public function getNumGuests(): ?int { return $this->numGuests; }
    public function setNumGuests(?int $numGuests): static { $this->numGuests = $numGuests; return $this; }

    public function getStatus(): string { return $this->status; }
    public function setStatus(?string $status): static { $this->status = $status ?? 'pending'; return $this; }

    public function getPaymentStatus(): string { return $this->paymentStatus; }
    public function setPaymentStatus(?string $paymentStatus): static { $this->paymentStatus = $paymentStatus ?? 'unpaid'; return $this; }

    public function getTotalAmount(): ?string { return $this->totalAmount; }
    public function setTotalAmount(?string $totalAmount): static { $this->totalAmount = $totalAmount; return $this; }

    public function getCurrency(): string { return $this->currency; }
    public function setCurrency(?string $currency): static { $this->currency = $currency ?? 'USD'; return $this; }

    public function getNotes(): ?string { return $this->notes; }
    public function setNotes(?string $notes): static { $this->notes = $notes; return $this; }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): static { $this->createdAt = $createdAt; return $this; }

    public function getUserEmail(): ?string { return $this->userEmail; }
    public function setUserEmail(?string $userEmail): static { $this->userEmail = $userEmail; return $this; }
}
