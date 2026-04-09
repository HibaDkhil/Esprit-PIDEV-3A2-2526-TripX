<?php
namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

use App\Form\ScheduleFieldsByType;

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

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $departureDatetime = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $arrivalDatetime = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $rentalStart = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $rentalEnd = null;

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

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $createdAt = null;

    public function __construct()
    {
        $this->priceMultiplier = 1.0;
        $this->status          = 'ON_TIME';
        $this->delayMinutes    = 0;
        $this->createdAt       = new DateTime();
    }

    public function getScheduleId(): ?int { return $this->scheduleId; }

    public function getTransportId(): int { return $this->transportId; }
    public function setTransportId(int $transportId): self { $this->transportId = $transportId; return $this; }

    public function getDepartureDestinationId(): int { return $this->departureDestinationId; }
    public function setDepartureDestinationId(int $departureDestinationId): self { $this->departureDestinationId = $departureDestinationId; return $this; }

    public function getArrivalDestinationId(): int { return $this->arrivalDestinationId; }
    public function setArrivalDestinationId(int $arrivalDestinationId): self { $this->arrivalDestinationId = $arrivalDestinationId; return $this; }

    public function getDepartureDatetime(): ?DateTime { return $this->departureDatetime; }
    public function setDepartureDatetime(?DateTime $departureDatetime): self { $this->departureDatetime = $departureDatetime; return $this; }

    public function getArrivalDatetime(): ?DateTime { return $this->arrivalDatetime; }
    public function setArrivalDatetime(?DateTime $arrivalDatetime): self { $this->arrivalDatetime = $arrivalDatetime; return $this; }

    public function getRentalStart(): ?DateTime { return $this->rentalStart; }
    public function setRentalStart(?DateTime $rentalStart): self { $this->rentalStart = $rentalStart; return $this; }

    public function getRentalEnd(): ?DateTime { return $this->rentalEnd; }
    public function setRentalEnd(?DateTime $rentalEnd): self { $this->rentalEnd = $rentalEnd; return $this; }

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

    public function getCreatedAt(): ?DateTime { return $this->createdAt; }
    public function setCreatedAt(?DateTime $createdAt): self { $this->createdAt = $createdAt; return $this; }
}

