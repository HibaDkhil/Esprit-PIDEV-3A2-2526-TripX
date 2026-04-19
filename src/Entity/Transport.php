<?php
namespace App\Entity;

use App\Repository\TransportRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TransportRepository::class)]
#[ORM\Table(name: 'transport')]
class Transport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $transportId;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: 'Transport type is required.')]                               // ★

    #[Assert\Choice(choices: ['FLIGHT', 'VEHICLE'], message: 'Type must be FLIGHT or VEHICLE.')]  // ★
    private string $transportType; // FLIGHT or VEHICLE

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: 'Provider name is required.')]                                // ★

    #[Assert\Length(max: 255, maxMessage: 'Provider name cannot exceed 255 characters.')]     // ★
    private string $providerName;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: 'Vehicle model is required.')]                                 // ★

    #[Assert\Length(max: 255, maxMessage: 'Vehicle model cannot exceed 255 characters.')]      // ★
    private string $vehicleModel;

    #[ORM\Column(type: 'float')]
    #[Assert\Positive(message: 'Base price must be greater than 0.')]
    private float $basePrice;

    #[ORM\Column(type: 'integer')]
    #[Assert\Positive(message: 'Capacity must be at least 1.')] 
    private int $capacity;

    #[ORM\Column(type: 'integer')]
    #[Assert\Positive(message: 'Available units must be at least 1.')]
    private int $availableUnits;

    #[ORM\Column(type: 'float')]
     #[Assert\Range(min: 0, max: 5, notInRangeMessage: 'Eco rating must be between {{ min }} and {{ max }}.')] // ★
    private float $sustainabilityRating;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $amenities = null;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Assert\File(
        maxSize: '5M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
        mimeTypesMessage: 'Please upload a valid image (JPEG, PNG, WebP)'
    )]
    private ?string $imageUrl = null;

    #[ORM\Column(type: 'float')]
    private float $dynamicPriceFactor;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $createdAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $updatedAt = null;

    // Constructor
    public function __construct()
    {
        $this->dynamicPriceFactor = 1.0;
        $this->isActive = true;
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    // Getters and Setters
    public function getTransportId(): int { return $this->transportId; }

    public function getTransportType(): string { return $this->transportType; }
    public function setTransportType(string $transportType): self { $this->transportType = $transportType; return $this; }

    public function getProviderName(): string { return $this->providerName; }
    public function setProviderName(string $providerName): self { $this->providerName = $providerName; return $this; }

    public function getVehicleModel(): string { return $this->vehicleModel; }
    public function setVehicleModel(string $vehicleModel): self { $this->vehicleModel = $vehicleModel; return $this; }

    public function getBasePrice(): float { return $this->basePrice; }
    public function setBasePrice(float $basePrice): self { $this->basePrice = $basePrice; return $this; }

    public function getCapacity(): int { return $this->capacity; }
    public function setCapacity(int $capacity): self { $this->capacity = $capacity; return $this; }

    public function getAvailableUnits(): int { return $this->availableUnits; }
    public function setAvailableUnits(int $availableUnits): self { $this->availableUnits = $availableUnits; return $this; }

    public function getSustainabilityRating(): float { return $this->sustainabilityRating; }
    public function setSustainabilityRating(float $sustainabilityRating): self { $this->sustainabilityRating = $sustainabilityRating; return $this; }

    public function getAmenities(): ?string { return $this->amenities; }
    public function setAmenities(?string $amenities): self { $this->amenities = $amenities; return $this; }

    public function getImageUrl(): ?string { return $this->imageUrl; }
    public function setImageUrl(?string $imageUrl): self { $this->imageUrl = $imageUrl; return $this; }

    public function getDynamicPriceFactor(): float { return $this->dynamicPriceFactor; }
    public function setDynamicPriceFactor(float $dynamicPriceFactor): self { $this->dynamicPriceFactor = $dynamicPriceFactor; return $this; }

    public function isActive(): bool { return $this->isActive; }
    public function setActive(bool $isActive): self { $this->isActive = $isActive; return $this; }

    public function getCreatedAt(): ?DateTime { return $this->createdAt; }
    public function setCreatedAt(?DateTime $createdAt): self { $this->createdAt = $createdAt; return $this; }

    public function getUpdatedAt(): ?DateTime { return $this->updatedAt; }
    public function setUpdatedAt(?DateTime $updatedAt): self { $this->updatedAt = $updatedAt; return $this; }
}