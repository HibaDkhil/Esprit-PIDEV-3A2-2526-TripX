<?php

namespace App\Entity;

use App\Repository\BookingAccRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BookingAccRepository::class)]
#[ORM\Table(name: 'bookingacc')]
class BookingAcc
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'user_id', type: 'integer')]
    #[Assert\NotNull(message: 'User ID is required')]
    #[Assert\Positive(message: 'User ID must be positive')]
    private ?int $userId = null;

    #[ORM\ManyToOne(targetEntity: Room::class)]
    #[ORM\JoinColumn(name: 'room_id', referencedColumnName: 'id', nullable: false)]
    #[Assert\NotNull(message: 'Room selection is required')]
    private ?Room $room = null;

    #[ORM\Column(name: 'check_in', type: 'date')]
    #[Assert\NotNull(message: 'Check-in date is required')]
    #[Assert\GreaterThanOrEqual(value: 'today', message: 'Check-in date cannot be in the past')]
    private ?\DateTimeInterface $checkIn = null;

    #[ORM\Column(name: 'check_out', type: 'date')]
    #[Assert\NotNull(message: 'Check-out date is required')]
    #[Assert\GreaterThan(propertyPath: 'checkIn', message: 'Check-out date must be after check-in date')]
    private ?\DateTimeInterface $checkOut = null;

    #[ORM\Column(name: 'total_price', type: 'decimal', precision: 10, scale: 2)]
    #[Assert\NotNull(message: 'Total price is required')]
    #[Assert\Positive(message: 'Total price must be positive')]
    #[Assert\Range(min: 0.01, max: 1000000, notInRangeMessage: 'Total price must be between {{ min }} and {{ max }}')]
    private ?string $totalPrice = null;

    #[ORM\Column(name: 'number_of_guests', type: 'integer', options: ['default' => 1])]
    #[Assert\NotNull(message: 'Number of guests is required')]
    #[Assert\Positive(message: 'Number of guests must be at least 1')]
    #[Assert\Range(min: 1, max: 50, notInRangeMessage: 'Number of guests must be between {{ min }} and {{ max }}')]
    private ?int $numberOfGuests = 1;

    #[ORM\Column(name: 'phone_number', type: 'string', length: 20, nullable: true)]
    #[Assert\NotBlank(message: 'Phone number is required')]
    #[Assert\Length(
        min: 8,
        max: 20,
        minMessage: 'Phone number must be at least {{ limit }} digits',
        maxMessage: 'Phone number cannot exceed {{ limit }} characters'
    )]
    #[Assert\Regex(
        pattern: '/^[0-9\+\-\s\(\)]+$/',
        message: 'Phone number contains invalid characters'
    )]
    private ?string $phoneNumber = null;

    #[ORM\Column(name: 'special_requests', type: 'text', nullable: true)]
    #[Assert\Length(max: 2000, maxMessage: 'Special requests cannot exceed {{ limit }} characters')]
    private ?string $specialRequests = null;

    #[ORM\Column(name: 'estimated_arrival_time', type: 'string', length: 20, nullable: true)]
    #[Assert\Regex(
        pattern: '/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/',
        message: 'Estimated arrival time must be in HH:MM format'
    )]
    private ?string $estimatedArrivalTime = null;

    #[ORM\Column(name: 'cancel_reason', type: 'text', nullable: true)]
    #[Assert\Length(max: 1000, maxMessage: 'Cancel reason cannot exceed {{ limit }} characters')]
    private ?string $cancelReason = null;

    #[ORM\Column(name: 'rejection_reason', type: 'text', nullable: true)]
    #[Assert\Length(max: 1000, maxMessage: 'Rejection reason cannot exceed {{ limit }} characters')]
    private ?string $rejectionReason = null;

    #[ORM\Column(name: 'cancelled_at', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $cancelledAt = null;

    #[ORM\Column(name: 'rejected_at', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $rejectedAt = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true, options: ['default' => 'PENDING'])]
    #[Assert\Choice(
        choices: ['PENDING', 'CONFIRMED', 'CANCELLED', 'REJECTED', 'COMPLETED'],
        message: 'Invalid status value'
    )]
    private ?string $status = 'PENDING';

    #[ORM\Column(name: 'created_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(name: 'google_calendar_event_id', type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    private ?string $googleCalendarEventId = null;

    #[ORM\Column(name: 'calendar_sync_status', type: 'string', length: 20, options: ['default' => 'NOT_SYNCED'])]
    #[Assert\Choice(
        choices: ['NOT_SYNCED', 'SYNCED', 'FAILED', 'PENDING'],
        message: 'Invalid calendar sync status'
    )]
    private ?string $calendarSyncStatus = 'NOT_SYNCED';

    #[ORM\Column(name: 'calendar_last_error', type: 'text', nullable: true)]
    #[Assert\Length(max: 500)]
    private ?string $calendarLastError = null;

    #[ORM\Column(name: 'calendar_synced_at', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $calendarSyncedAt = null;

    // ─── Getters & Setters (keep existing) ───────────────────────────

    public function getId(): ?int { return $this->id; }

    public function getUserId(): ?int { return $this->userId; }
    public function setUserId(int $userId): static { $this->userId = $userId; return $this; }

    public function getRoom(): ?Room { return $this->room; }
    public function setRoom(?Room $room): static { $this->room = $room; return $this; }

    public function getCheckIn(): ?\DateTimeInterface { return $this->checkIn; }
    public function setCheckIn(\DateTimeInterface $checkIn): static { $this->checkIn = $checkIn; return $this; }

    public function getCheckOut(): ?\DateTimeInterface { return $this->checkOut; }
    public function setCheckOut(\DateTimeInterface $checkOut): static { $this->checkOut = $checkOut; return $this; }

    public function getTotalPrice(): ?string { return $this->totalPrice; }
    public function setTotalPrice(string $totalPrice): static { $this->totalPrice = $totalPrice; return $this; }

    public function getNumberOfGuests(): ?int { return $this->numberOfGuests; }
    public function setNumberOfGuests(int $numberOfGuests): static { $this->numberOfGuests = $numberOfGuests; return $this; }

    public function getPhoneNumber(): ?string { return $this->phoneNumber; }
    public function setPhoneNumber(?string $phoneNumber): static { $this->phoneNumber = $phoneNumber; return $this; }

    public function getSpecialRequests(): ?string { return $this->specialRequests; }
    public function setSpecialRequests(?string $specialRequests): static { $this->specialRequests = $specialRequests; return $this; }

    public function getEstimatedArrivalTime(): ?string { return $this->estimatedArrivalTime; }
    public function setEstimatedArrivalTime(?string $estimatedArrivalTime): static { $this->estimatedArrivalTime = $estimatedArrivalTime; return $this; }

    public function getCancelReason(): ?string { return $this->cancelReason; }
    public function setCancelReason(?string $cancelReason): static { $this->cancelReason = $cancelReason; return $this; }

    public function getRejectionReason(): ?string { return $this->rejectionReason; }
    public function setRejectionReason(?string $rejectionReason): static { $this->rejectionReason = $rejectionReason; return $this; }

    public function getCancelledAt(): ?\DateTimeInterface { return $this->cancelledAt; }
    public function setCancelledAt(?\DateTimeInterface $cancelledAt): static { $this->cancelledAt = $cancelledAt; return $this; }

    public function getRejectedAt(): ?\DateTimeInterface { return $this->rejectedAt; }
    public function setRejectedAt(?\DateTimeInterface $rejectedAt): static { $this->rejectedAt = $rejectedAt; return $this; }

    public function getStatus(): ?string { return $this->status; }
    public function setStatus(?string $status): static { $this->status = $status; return $this; }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): static { $this->createdAt = $createdAt; return $this; }

    public function getGoogleCalendarEventId(): ?string { return $this->googleCalendarEventId; }
    public function setGoogleCalendarEventId(?string $googleCalendarEventId): static { $this->googleCalendarEventId = $googleCalendarEventId; return $this; }

    public function getCalendarSyncStatus(): ?string { return $this->calendarSyncStatus; }
    public function setCalendarSyncStatus(string $calendarSyncStatus): static { $this->calendarSyncStatus = $calendarSyncStatus; return $this; }

    public function getCalendarLastError(): ?string { return $this->calendarLastError; }
    public function setCalendarLastError(?string $calendarLastError): static { $this->calendarLastError = $calendarLastError; return $this; }

    public function getCalendarSyncedAt(): ?\DateTimeInterface { return $this->calendarSyncedAt; }
    public function setCalendarSyncedAt(?\DateTimeInterface $calendarSyncedAt): static { $this->calendarSyncedAt = $calendarSyncedAt; return $this; }
}