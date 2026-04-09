<?php

namespace App\Entity;

use App\Repository\AccommodationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AccommodationRepository::class)]
#[ORM\Table(name: 'accommodation')]
class Accommodation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Assert\NotBlank(message: 'Accommodation name is required')]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: 'Name must be at least {{ limit }} characters',
        maxMessage: 'Name cannot exceed {{ limit }} characters'
    )]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    #[Assert\Choice(
        choices: ['Hotel', 'Resort', 'Villa', 'Hostel', 'Apartment', 'Guest House', 'Boutique', 'Motel'],
        message: 'Please select a valid accommodation type'
    )]
    private ?string $type = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Assert\NotBlank(message: 'City is required')]
    #[Assert\Length(max: 100, maxMessage: 'City name cannot exceed {{ limit }} characters')]
    private ?string $city = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Assert\NotBlank(message: 'Country is required')]
    #[Assert\Length(max: 100, maxMessage: 'Country name cannot exceed {{ limit }} characters')]
    private ?string $country = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 8, nullable: true)]
    #[Assert\NotBlank(message: 'Please pick a location from the map')]
    #[Assert\Range(
        min: -90,
        max: 90,
        notInRangeMessage: 'Latitude must be between {{ min }} and {{ max }} degrees'
    )]
    private ?string $latitude = null;

    #[ORM\Column(type: 'decimal', precision: 11, scale: 8, nullable: true)]
    #[Assert\NotBlank(message: 'Please pick a location from the map')]
    #[Assert\Range(
        min: -180,
        max: 180,
        notInRangeMessage: 'Longitude must be between {{ min }} and {{ max }} degrees'
    )]
    private ?string $longitude = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: 'Address cannot exceed {{ limit }} characters')]
    private ?string $address = null;

    #[ORM\Column(name: 'postal_code', type: 'string', length: 20, nullable: true)]
    #[Assert\Length(max: 20, maxMessage: 'Postal code cannot exceed {{ limit }} characters')]
    private ?string $postalCode = null;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\Length(max: 5000, maxMessage: 'Description cannot exceed {{ limit }} characters')]
    private ?string $description = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\NotNull(message: 'Star rating is required')]
    #[Assert\NotBlank(message: 'Star rating is required')]
    #[Assert\Range(
        min: 1,
        max: 5,
        notInRangeMessage: 'Stars must be between {{ min }} and {{ max }}'
    )]
    private ?int $stars = null;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Assert\Range(
        min: 0,
        max: 5,
        notInRangeMessage: 'Rating must be between {{ min }} and {{ max }}'
    )]
    private ?float $rating = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true, options: ['default' => 'Active'])]
    #[Assert\Choice(
        choices: ['Active', 'Inactive'],
        message: 'Status must be either Active or Inactive'
    )]
    private ?string $status = 'Active';

    #[ORM\Column(name: 'image_path', type: 'string', length: 500, nullable: true)]
    #[Assert\Length(max: 500, maxMessage: 'Image path is too long')]
    private ?string $imagePath = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Assert\NotBlank(message: 'Phone number is required')]
    #[Assert\Length(
        min: 8,
        max: 15,
        minMessage: 'Phone number must be at least {{ limit }} digits',
        maxMessage: 'Phone number cannot exceed {{ limit }} digits'
    )]
    #[Assert\Regex(
        pattern: '/^[0-9\+][0-9\s\-\(\)]+$/',
        message: 'Phone number must contain only numbers, spaces, dashes, parentheses, or a plus sign'
    )]
    private ?string $phone = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Assert\NotBlank(message: 'Email address is required')]
    #[Assert\Email(message: 'Please enter a valid email address (e.g., name@example.com)')]
    #[Assert\Length(max: 100, maxMessage: 'Email cannot exceed {{ limit }} characters')]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    #[Assert\NotBlank(message: 'Website URL is required')]
    #[Assert\Url(message: 'Please enter a valid URL (e.g., https://example.com)')]
    #[Assert\Length(max: 200, maxMessage: 'Website URL cannot exceed {{ limit }} characters')]
    private ?string $website = null;

    #[ORM\Column(name: 'created_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(name: 'updated_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(name: 'accommodation_amenities', type: 'text', nullable: true)]
    private ?string $accommodationAmenities = null;

    // ─── Getters & Setters ───────────────────────────

    public function getId(): ?int { return $this->id; }

    public function getName(): ?string { return $this->name; }
    public function setName(?string $name): static { $this->name = $name; return $this; }

    public function getType(): ?string { return $this->type; }
    public function setType(?string $type): static { $this->type = $type; return $this; }

    public function getCity(): ?string { return $this->city; }
    public function setCity(?string $city): static { $this->city = $city; return $this; }

    public function getCountry(): ?string { return $this->country; }
    public function setCountry(?string $country): static { $this->country = $country; return $this; }

    public function getLatitude(): ?string { return $this->latitude; }
    public function setLatitude(?string $latitude): static { $this->latitude = $latitude; return $this; }

    public function getLongitude(): ?string { return $this->longitude; }
    public function setLongitude(?string $longitude): static { $this->longitude = $longitude; return $this; }

    public function getAddress(): ?string { return $this->address; }
    public function setAddress(?string $address): static { $this->address = $address; return $this; }

    public function getPostalCode(): ?string { return $this->postalCode; }
    public function setPostalCode(?string $postalCode): static { $this->postalCode = $postalCode; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): static { $this->description = $description; return $this; }

    public function getStars(): ?int { return $this->stars; }
    public function setStars(?int $stars): static { $this->stars = $stars; return $this; }

    public function getRating(): ?float { return $this->rating; }
    public function setRating(?float $rating): static { $this->rating = $rating; return $this; }

    public function getStatus(): ?string { return $this->status; }
    public function setStatus(?string $status): static { $this->status = $status; return $this; }

    public function getImagePath(): ?string { return $this->imagePath; }
    public function setImagePath(?string $imagePath): static { $this->imagePath = $imagePath; return $this; }

    public function getPhone(): ?string { return $this->phone; }
    public function setPhone(?string $phone): static { $this->phone = $phone; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?string $email): static { $this->email = $email; return $this; }

    public function getWebsite(): ?string { return $this->website; }
    public function setWebsite(?string $website): static { $this->website = $website; return $this; }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): static { $this->createdAt = $createdAt; return $this; }

    public function getUpdatedAt(): ?\DateTimeInterface { return $this->updatedAt; }
    public function setUpdatedAt(\DateTimeInterface $updatedAt): static { $this->updatedAt = $updatedAt; return $this; }

    public function getAccommodationAmenities(): ?string { return $this->accommodationAmenities; }
    public function setAccommodationAmenities(?string $accommodationAmenities): static { $this->accommodationAmenities = $accommodationAmenities; return $this; }
}