<?php
namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use App\form\ScheduleFieldsByType;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
#[ORM\Table(name: 'schedule')]
#[ScheduleFieldsByType] 
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $scheduleId = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\Positive(message: 'Please select a transport.')]
    private int $transportId = 0;

    #[ORM\Column(type: 'bigint')]
    #[Assert\Positive(message: 'Please select a departure destination.')]
    private int $departureDestinationId = 0;

    #[ORM\Column(type: 'bigint')]
    #[Assert\Positive(message: 'Please select an arrival destination.')] 
    private int $arrivalDestinationId = 0;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $departureDatetime = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $arrivalDatetime = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $rentalStart = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $rentalEnd = null;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Assert\NotBlank(message: 'Travel class is required.')]                                  // ★

    #[Assert\Choice(

        choices: ['ECONOMY', 'PREMIUM', 'BUSINESS', 'FIRST'],

        message: 'Travel class must be ECONOMY, PREMIUM, BUSINESS or FIRST.'

    )]
    private ?string $travelClass = null;

    #[ORM\Column(type: 'float')]
    #[Assert\Positive(message: 'Price multiplier must be greater than 0.')]
    private float $priceMultiplier = 1.0;

    #[ORM\Column(type: 'string', options: ['default' => 'ON_TIME'])]
    #[Assert\Choice(
        choices: ['ON_TIME', 'DELAYED', 'CANCELLED', 'COMPLETED', 'BOARDING'],
        message: 'Invalid schedule status.'
    )] 
    private string $status = 'ON_TIME';

    #[ORM\Column(type: 'integer')]
    private int $delayMinutes = 0;

    #[ORM\Column(type: 'float')]
    private float $aiDemandScore = 0.0;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->priceMultiplier = 1.0;
        $this->status          = 'ON_TIME';
        $this->delayMinutes    = 0;
        $this->createdAt       = new \DateTimeImmutable();
    }

    public function getScheduleId(): ?int { return $this->scheduleId; }

    public function getTransportId(): int { return $this->transportId; }
    public function setTransportId(int $transportId): self { $this->transportId = $transportId; return $this; }

    public function getDepartureDestinationId(): int { return $this->departureDestinationId; }
    public function setDepartureDestinationId(int $departureDestinationId): self { $this->departureDestinationId = $departureDestinationId; return $this; }

    public function getArrivalDestinationId(): int { return $this->arrivalDestinationId; }
    public function setArrivalDestinationId(int $arrivalDestinationId): self { $this->arrivalDestinationId = $arrivalDestinationId; return $this; }

    public function getDepartureDatetime(): ?\DateTimeImmutable { return $this->departureDatetime; }
    public function setDepartureDatetime(?\DateTimeInterface $departureDatetime): self { $this->departureDatetime = $departureDatetime ? \DateTimeImmutable::createFromInterface($departureDatetime) : null; return $this; }

    public function getArrivalDatetime(): ?\DateTimeImmutable { return $this->arrivalDatetime; }
    public function setArrivalDatetime(?\DateTimeInterface $arrivalDatetime): self { $this->arrivalDatetime = $arrivalDatetime ? \DateTimeImmutable::createFromInterface($arrivalDatetime) : null; return $this; }

    public function getRentalStart(): ?\DateTimeImmutable { return $this->rentalStart; }
    public function setRentalStart(?\DateTimeInterface $rentalStart): self { $this->rentalStart = $rentalStart ? \DateTimeImmutable::createFromInterface($rentalStart) : null; return $this; }

    public function getRentalEnd(): ?\DateTimeImmutable { return $this->rentalEnd; }
    public function setRentalEnd(?\DateTimeInterface $rentalEnd): self { $this->rentalEnd = $rentalEnd ? \DateTimeImmutable::createFromInterface($rentalEnd) : null; return $this; }

    public function getTravelClass(): ?string { return $this->travelClass; }
    public function setTravelClass(?string $travelClass): self { $this->travelClass = $travelClass; return $this; }

    public function getPriceMultiplier(): float { return $this->priceMultiplier; }
    public function setPriceMultiplier(float $priceMultiplier): self { $this->priceMultiplier = $priceMultiplier; return $this; }

    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }

    public function getDelayMinutes(): int { return $this->delayMinutes; }
    public function setDelayMinutes(int $delayMinutes): self { $this->delayMinutes = $delayMinutes; return $this; }

    public function getAiDemandScore(): float { return $this->aiDemandScore; }
    public function setAiDemandScore(float $aiDemandScore): self { $this->aiDemandScore = $aiDemandScore; return $this; }

    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): self { $this->createdAt = \DateTimeImmutable::createFromInterface($createdAt); return $this; }
}

