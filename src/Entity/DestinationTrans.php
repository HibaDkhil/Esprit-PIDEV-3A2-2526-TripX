<?php

namespace App\Entity;

use App\Repository\DestinationTransRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DestinationTransRepository::class)]
#[ORM\Table(name: 'destination_trans')]
class DestinationTrans
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'destination_id', type: 'integer')]
    private ?int $destinationId = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Name is required.')]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message: 'Type is required.')]
    private ?string $type = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message: 'Country is required.')]
    private ?string $country = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message: 'City is required.')]
    private ?string $city = null;

    #[ORM\Column(name: 'best_season', type: 'string', length: 50)]
    #[Assert\NotBlank(message: 'Best season is required.')]
    private ?string $bestSeason = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 64, nullable: true)]
    private ?string $timezone = null;

    #[ORM\Column(name: 'average_rating', type: 'float')]
    #[Assert\Range(min: 0, max: 5)]
    private float $averageRating = 0.0;

    public function getDestinationId(): ?int { return $this->destinationId; }

    public function getName(): ?string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }

    public function getType(): ?string { return $this->type; }
    public function setType(string $type): self { $this->type = $type; return $this; }

    public function getCountry(): ?string { return $this->country; }
    public function setCountry(string $country): self { $this->country = $country; return $this; }

    public function getCity(): ?string { return $this->city; }
    public function setCity(string $city): self { $this->city = $city; return $this; }

    public function getBestSeason(): ?string { return $this->bestSeason; }
    public function setBestSeason(string $bestSeason): self { $this->bestSeason = $bestSeason; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }

    public function getTimezone(): ?string { return $this->timezone; }
    public function setTimezone(?string $timezone): self { $this->timezone = $timezone; return $this; }

    public function getAverageRating(): float { return $this->averageRating; }
    public function setAverageRating(float $averageRating): self { $this->averageRating = $averageRating; return $this; }
}
