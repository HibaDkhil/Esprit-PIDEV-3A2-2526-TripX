<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
#[ORM\Table(name: 'room')]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Accommodation::class)]
    #[ORM\JoinColumn(name: 'accommodation_id', referencedColumnName: 'id', nullable: true)]
    private ?Accommodation $accommodation = null;

    #[ORM\Column(name: 'room_name', type: 'string', length: 100, nullable: true)]
    #[Assert\NotBlank(message: 'Room name is required')]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: 'Room name must be at least {{ limit }} characters',
        maxMessage: 'Room name cannot exceed {{ limit }} characters'
    )]
    private ?string $roomName = null;

    #[ORM\Column(name: 'room_type', type: 'string', length: 50, nullable: true)]
    #[Assert\NotBlank(message: 'Room type is required')]
    #[Assert\Choice(
        choices: ['Single Room', 'Double Room', 'Twin Room', 'Suite', 'Family Room', 'Deluxe Room', 'Penthouse', 'Studio'],
        message: 'Please select a valid room type'
    )]
    private ?string $roomType = null;

    #[ORM\Column(name: 'price_per_night', type: 'float', nullable: true)]
    #[Assert\NotNull(message: 'Price per night is required')]
    #[Assert\NotBlank(message: 'Price per night is required')]
    #[Assert\Positive(message: 'Price per night must be a positive number')]
    #[Assert\Range(
        min: 1,
        max: 100000,
        notInRangeMessage: 'Price per night must be between {{ min }} and {{ max }}'
    )]
    private ?float $pricePerNight = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\NotNull(message: 'Capacity is required')]
    #[Assert\NotBlank(message: 'Capacity is required')]
    #[Assert\Positive(message: 'Capacity must be at least 1 person')]
    #[Assert\Range(
        min: 1,
        max: 50,
        notInRangeMessage: 'Capacity must be between {{ min }} and {{ max }} persons'
    )]
    private ?int $capacity = null;

    #[ORM\Column(type: 'decimal', precision: 8, scale: 2, nullable: true)]
    #[Assert\NotBlank(message: 'Room size is required')]
    #[Assert\Positive(message: 'Size must be greater than 0')]
    #[Assert\Range(
        min: 1,
        max: 1000,
        notInRangeMessage: 'Size must be between {{ min }} and {{ max }} m²'
    )]
    private ?string $size = null;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\Length(max: 2000, maxMessage: 'Amenities cannot exceed {{ limit }} characters')]
    private ?string $amenities = null;

    #[ORM\Column(name: 'is_available', type: 'boolean', nullable: true, options: ['default' => true])]
    #[Assert\Type(type: 'bool', message: 'Availability must be true or false')]
    private ?bool $isAvailable = true;

    // ─── Getters & Setters ───────────────────────────

    public function getId(): ?int { return $this->id; }

    public function getAccommodation(): ?Accommodation { return $this->accommodation; }
    public function setAccommodation(?Accommodation $accommodation): static { $this->accommodation = $accommodation; return $this; }

    public function getRoomName(): ?string { return $this->roomName; }
    public function setRoomName(?string $roomName): static { $this->roomName = $roomName; return $this; }

    public function getRoomType(): ?string { return $this->roomType; }
    public function setRoomType(?string $roomType): static { $this->roomType = $roomType; return $this; }

    public function getPricePerNight(): ?float { return $this->pricePerNight; }
    public function setPricePerNight(?float $pricePerNight): static { $this->pricePerNight = $pricePerNight; return $this; }

    public function getCapacity(): ?int { return $this->capacity; }
    public function setCapacity(?int $capacity): static { $this->capacity = $capacity; return $this; }

    public function getSize(): ?string { return $this->size; }
    public function setSize(?string $size): static { $this->size = $size; return $this; }

    public function getAmenities(): ?string { return $this->amenities; }
    public function setAmenities(?string $amenities): static { $this->amenities = $amenities; return $this; }

    public function isAvailable(): ?bool { return $this->isAvailable; }
    public function setIsAvailable(?bool $isAvailable): static { $this->isAvailable = $isAvailable; return $this; }
}