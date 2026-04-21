<?php
namespace App\Entity;

use App\Repository\BookingtransRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BookingtransRepository::class)]
#[ORM\Table(name: 'bookingtrans')]
class Bookingtrans
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $bookingId = null;

    #[ORM\Column(type: 'integer')]
    private int $userId = 0;

    #[ORM\Column(type: 'integer')]
    private int $transportId = 0;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $scheduleId = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $bookingDate = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\Positive(message: 'At least 1 adult is required.')]
    private int $adultsCount = 0;

    #[ORM\Column(type: 'integer')]
    #[Assert\GreaterThanOrEqual(value: 0, message: 'Children count cannot be negative.')]
    private int $childrenCount = 0;

    #[ORM\Column(type: 'integer')]
    #[Assert\Positive(message: 'Total seats must be at least 1.')]
    private int $totalSeats = 0;

    #[ORM\Column(type: 'float')]
    #[Assert\Positive(message: 'Total price must be greater than 0.')]
    private float $totalPrice = 0.0;

    #[ORM\Column(type: 'string')]
    #[Assert\Choice(choices: ['PENDING', 'CONFIRMED', 'CANCELLED'], message: 'Invalid booking status.')]
    private string $bookingStatus = 'PENDING';

    #[ORM\Column(type: 'string')]
    private string $paymentStatus = 'UNPAID';

    #[ORM\Column(type: 'boolean')]
    private bool $insuranceIncluded = false;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $qrCode = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $voucherPath = null;

    #[ORM\Column(type: 'float')]
    private float $aiPricePrediction = 0.0;

    #[ORM\Column(type: 'float')]
    private float $comparisonScore = 0.0;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $cancellationReason = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $pickupLatitude = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $pickupLongitude = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $pickupAddress = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $dropoffLatitude = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $dropoffLongitude = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $dropoffAddress = null;


    public function __construct()
    {
        $this->bookingStatus     = 'PENDING';
        $this->paymentStatus     = 'UNPAID';
        $this->insuranceIncluded = false;
        $this->bookingDate       = new DateTime();
        $this->scheduleId        = null;
    }

    public function getBookingId(): ?int { return $this->bookingId; }

    public function getUserId(): int { return $this->userId; }
    public function setUserId(int $userId): self { $this->userId = $userId; return $this; }

    public function getTransportId(): int { return $this->transportId; }
    public function setTransportId(int $transportId): self { $this->transportId = $transportId; return $this; }

    public function getScheduleId(): int { return $this->scheduleId ?? 0; }
    public function setScheduleId(?int $scheduleId): self { $this->scheduleId = ($scheduleId !== null && $scheduleId > 0) ? $scheduleId : null; return $this; }

    public function getBookingDate(): ?DateTime { return $this->bookingDate; }
    public function setBookingDate(?DateTime $bookingDate): self { $this->bookingDate = $bookingDate; return $this; }

    public function getAdultsCount(): int { return $this->adultsCount; }
    public function setAdultsCount(int $adultsCount): self { $this->adultsCount = $adultsCount; return $this; }

    public function getChildrenCount(): int { return $this->childrenCount; }
    public function setChildrenCount(int $childrenCount): self { $this->childrenCount = $childrenCount; return $this; }

    public function getTotalSeats(): int { return $this->totalSeats; }
    public function setTotalSeats(int $totalSeats): self { $this->totalSeats = $totalSeats; return $this; }

    public function getTotalPrice(): float { return $this->totalPrice; }
    public function setTotalPrice(float $totalPrice): self { $this->totalPrice = $totalPrice; return $this; }

    public function getBookingStatus(): string { return $this->bookingStatus; }
    public function setBookingStatus(string $bookingStatus): self { $this->bookingStatus = $bookingStatus; return $this; }

    public function getPaymentStatus(): string { return $this->paymentStatus; }
    public function setPaymentStatus(string $paymentStatus): self { $this->paymentStatus = $paymentStatus; return $this; }

    public function isInsuranceIncluded(): bool { return $this->insuranceIncluded; }
    public function setInsuranceIncluded(bool $insuranceIncluded): self { $this->insuranceIncluded = $insuranceIncluded; return $this; }

    public function getQrCode(): ?string { return $this->qrCode; }
    public function setQrCode(?string $qrCode): self { $this->qrCode = $qrCode; return $this; }

    public function getVoucherPath(): ?string { return $this->voucherPath; }
    public function setVoucherPath(?string $voucherPath): self { $this->voucherPath = $voucherPath; return $this; }

    public function getAiPricePrediction(): float { return $this->aiPricePrediction; }
    public function setAiPricePrediction(float $aiPricePrediction): self { $this->aiPricePrediction = $aiPricePrediction; return $this; }

    public function getComparisonScore(): float { return $this->comparisonScore; }
    public function setComparisonScore(float $comparisonScore): self { $this->comparisonScore = $comparisonScore; return $this; }

    public function getCancellationReason(): ?string { return $this->cancellationReason; }
    public function setCancellationReason(?string $cancellationReason): self { $this->cancellationReason = $cancellationReason; return $this; }

    public function getPickupLatitude(): ?float { return $this->pickupLatitude; }
    public function setPickupLatitude(?float $pickupLatitude): self { $this->pickupLatitude = $pickupLatitude; return $this; }

    public function getPickupLongitude(): ?float { return $this->pickupLongitude; }
    public function setPickupLongitude(?float $pickupLongitude): self { $this->pickupLongitude = $pickupLongitude; return $this; }

    public function getPickupAddress(): ?string { return $this->pickupAddress; }
    public function setPickupAddress(?string $pickupAddress): self { $this->pickupAddress = $pickupAddress; return $this; }

    public function getDropoffLatitude(): ?float { return $this->dropoffLatitude; }
    public function setDropoffLatitude(?float $dropoffLatitude): self { $this->dropoffLatitude = $dropoffLatitude; return $this; }

    public function getDropoffLongitude(): ?float { return $this->dropoffLongitude; }
    public function setDropoffLongitude(?float $dropoffLongitude): self { $this->dropoffLongitude = $dropoffLongitude; return $this; }

    public function getDropoffAddress(): ?string { return $this->dropoffAddress; }
    public function setDropoffAddress(?string $dropoffAddress): self { $this->dropoffAddress = $dropoffAddress; return $this; }

}