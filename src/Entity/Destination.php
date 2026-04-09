<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\DestinationRepository;

#[ORM\Entity(repositoryClass: DestinationRepository::class)]
#[ORM\Table(name: 'destinations')]
class Destination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'destination_id', type: 'bigint')]
    private ?string $destinationId = null;

    #[ORM\Column(type: 'string', length: 150)]
    #[Assert\NotBlank(message: 'The destination name is required.')]
    #[Assert\Length(max: 150, maxMessage: 'The name cannot be longer than {{ limit }} characters.')]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message: 'The destination type is required.')]
    #[Assert\Choice(choices: ['city', 'beach', 'mountain', 'countryside', 'desert', 'island', 'forest', 'cruise', 'other'], message: 'Choose a valid destination type.')]
    private ?string $type = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message: 'The country is required.')]
    #[Assert\Length(max: 100, maxMessage: 'The country cannot be longer than {{ limit }} characters.')]
    private ?string $country = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Assert\Length(max: 100, maxMessage: 'The city cannot be longer than {{ limit }} characters.')]
    private ?string $city = null;

    #[ORM\Column(name: 'best_season', type: 'string', length: 20)]
    #[Assert\NotBlank(message: 'The best season is required.')]
    #[Assert\Choice(choices: ['spring', 'summer', 'autumn', 'winter', 'all_year'], message: 'Choose a valid season.')]
    private ?string $bestSeason = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    private ?string $timezone = null;

    #[ORM\Column(name: 'average_rating', type: 'decimal', precision: 3, scale: 2, options: ['default' => '0.00'])]
    #[Assert\PositiveOrZero(message: 'Rating must be a positive number or zero.')]
    private ?string $averageRating = '0.00';

    #[ORM\Column(name: 'image_url', type: 'string', length: 500, nullable: true)]
    #[Assert\Url(message: 'The image URL is not valid.')]
    #[Assert\Length(max: 500)]
    private ?string $imageUrl = null;

    #[ORM\Column(name: 'created_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 8, nullable: true)]
    #[Assert\Range(min: -90, max: 90, notInRangeMessage: 'Latitude must be between {{ min }} and {{ max }}.')]
    private ?string $latitude = null;

    #[ORM\Column(type: 'decimal', precision: 11, scale: 8, nullable: true)]
    #[Assert\Range(min: -180, max: 180, notInRangeMessage: 'Longitude must be between {{ min }} and {{ max }}.')]
    private ?string $longitude = null;

    #[ORM\Column(name: 'estimated_budget', type: 'decimal', precision: 10, scale: 2, nullable: true)]
    #[Assert\PositiveOrZero(message: 'Estimated budget must be a positive number or zero.')]
    private ?string $estimatedBudget = null;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    #[Assert\PositiveOrZero]
    private ?int $popularity = 0;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getDestinationId(): ?string { return $this->destinationId; }
    public function getId(): ?string { return $this->destinationId; }

    public function getName(): ?string { return $this->name; }
    public function setName(?string $name): static { $this->name = $name; return $this; }

    public function getType(): ?string { return $this->type; }
    public function setType(?string $type): static { $this->type = $type; return $this; }

    public function getCountry(): ?string { return $this->country; }
    public function setCountry(?string $country): static { $this->country = $country; return $this; }

    public function getCity(): ?string { return $this->city; }
    public function setCity(?string $city): static { $this->city = $city; return $this; }

    public function getBestSeason(): ?string { return $this->bestSeason; }
    public function setBestSeason(?string $bestSeason): static { $this->bestSeason = $bestSeason; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): static { $this->description = $description; return $this; }

    public function getTimezone(): ?string { return $this->timezone; }
    public function setTimezone(?string $timezone): static { $this->timezone = $timezone; return $this; }

    public function getAverageRating(): ?string { return $this->averageRating; }
    public function setAverageRating(string $averageRating): static { $this->averageRating = $averageRating; return $this; }

    public function getImageUrl(): ?string { return $this->imageUrl; }
    public function setImageUrl(?string $imageUrl): static { $this->imageUrl = $imageUrl; return $this; }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): static { $this->createdAt = $createdAt; return $this; }

    public function getLatitude(): ?string { return $this->latitude; }
    public function setLatitude(?string $latitude): static { $this->latitude = $latitude; return $this; }

    public function getLongitude(): ?string { return $this->longitude; }
    public function setLongitude(?string $longitude): static { $this->longitude = $longitude; return $this; }

    public function getEstimatedBudget(): ?string { return $this->estimatedBudget; }
    public function setEstimatedBudget(?string $estimatedBudget): static { $this->estimatedBudget = $estimatedBudget; return $this; }

    public function getPopularity(): ?int { return $this->popularity; }
    public function setPopularity(int $popularity): static { $this->popularity = $popularity; return $this; }
}
