<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'activities')]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'activity_id', type: 'bigint')]
    private ?string $activityId = null;

    #[ORM\Column(name: 'destination_id', type: 'bigint')]
    private ?string $destinationId = null;

    #[ORM\Column(type: 'string', length: 160)]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $category = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(name: 'duration_minutes', type: 'smallint', nullable: true)]
    private ?int $durationMinutes = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?string $price = null;

    #[ORM\Column(type: 'string', length: 3, options: ['default' => 'USD'])]
    private ?string $currency = 'USD';

    #[ORM\Column(name: 'age_min', type: 'smallint', nullable: true)]
    private ?int $ageMin = null;

    #[ORM\Column(type: 'smallint', nullable: true)]
    private ?int $capacity = null;

    #[ORM\Column(name: 'available_from', type: 'date', nullable: true)]
    private ?\DateTimeInterface $availableFrom = null;

    #[ORM\Column(name: 'available_to', type: 'date', nullable: true)]
    private ?\DateTimeInterface $availableTo = null;

    #[ORM\Column(name: 'meeting_point', type: 'string', length: 255, nullable: true)]
    private ?string $meetingPoint = null;

    #[ORM\Column(name: 'average_rating', type: 'decimal', precision: 3, scale: 2, options: ['default' => '0.00'])]
    private ?string $averageRating = '0.00';

    #[ORM\Column(name: 'is_active', type: 'boolean', options: ['default' => true])]
    private ?bool $isActive = true;

    #[ORM\Column(name: 'created_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getActivityId(): ?string { return $this->activityId; }
    public function getId(): ?string { return $this->activityId; }

    public function getDestinationId(): ?string { return $this->destinationId; }
    public function setDestinationId(string $destinationId): static { $this->destinationId = $destinationId; return $this; }

    public function getName(): ?string { return $this->name; }
    public function setName(string $name): static { $this->name = $name; return $this; }

    public function getCategory(): ?string { return $this->category; }
    public function setCategory(string $category): static { $this->category = $category; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): static { $this->description = $description; return $this; }

    public function getDurationMinutes(): ?int { return $this->durationMinutes; }
    public function setDurationMinutes(?int $durationMinutes): static { $this->durationMinutes = $durationMinutes; return $this; }

    public function getPrice(): ?string { return $this->price; }
    public function setPrice(?string $price): static { $this->price = $price; return $this; }

    public function getCurrency(): ?string { return $this->currency; }
    public function setCurrency(string $currency): static { $this->currency = $currency; return $this; }

    public function getAgeMin(): ?int { return $this->ageMin; }
    public function setAgeMin(?int $ageMin): static { $this->ageMin = $ageMin; return $this; }

    public function getCapacity(): ?int { return $this->capacity; }
    public function setCapacity(?int $capacity): static { $this->capacity = $capacity; return $this; }

    public function getAvailableFrom(): ?\DateTimeInterface { return $this->availableFrom; }
    public function setAvailableFrom(?\DateTimeInterface $availableFrom): static { $this->availableFrom = $availableFrom; return $this; }

    public function getAvailableTo(): ?\DateTimeInterface { return $this->availableTo; }
    public function setAvailableTo(?\DateTimeInterface $availableTo): static { $this->availableTo = $availableTo; return $this; }

    public function getMeetingPoint(): ?string { return $this->meetingPoint; }
    public function setMeetingPoint(?string $meetingPoint): static { $this->meetingPoint = $meetingPoint; return $this; }

    public function getAverageRating(): ?string { return $this->averageRating; }
    public function setAverageRating(string $averageRating): static { $this->averageRating = $averageRating; return $this; }

    public function isIsActive(): ?bool { return $this->isActive; }
    public function setIsActive(bool $isActive): static { $this->isActive = $isActive; return $this; }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): static { $this->createdAt = $createdAt; return $this; }
}
