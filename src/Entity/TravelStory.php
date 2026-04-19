<?php

namespace App\Entity;

use App\Repository\TravelStoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TravelStoryRepository::class)]
#[ORM\Table(name: 'travel_story')]
class TravelStory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'travel_story_id', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'user_id', type: 'integer')]
    #[Assert\NotNull]
    private ?int $userId = null;

    #[ORM\Column(name: 'destination_id', type: 'bigint', nullable: true)]
    private ?string $destinationId = null;

    #[ORM\Column(name: 'title', type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    private ?string $title = null;

    #[ORM\Column(name: 'summary', type: Types::TEXT, nullable: true)]
    #[Assert\Length(max: 5000)]
    private ?string $summary = null;

    #[ORM\Column(name: 'start_date', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(name: 'end_date', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column(name: 'travel_type', type: 'string', length: 20, nullable: true)]
    #[Assert\Choice(choices: ['solo', 'couple', 'family', 'friends', 'business'])]
    private ?string $travelType = null;

    #[ORM\Column(name: 'travel_style', type: 'string', length: 20, nullable: true)]
    #[Assert\Choice(choices: ['luxury', 'budget', 'adventure', 'relax', 'cultural', 'roadtrip'])]
    private ?string $travelStyle = null;

    #[ORM\Column(name: 'overall_rating', type: 'smallint', nullable: true, options: ['unsigned' => true])]
    #[Assert\Range(min: 1, max: 5)]
    private ?int $overallRating = null;

    #[ORM\Column(name: 'would_recommend', type: 'boolean', options: ['default' => true])]
    private bool $wouldRecommend = true;

    #[ORM\Column(name: 'would_go_again', type: 'boolean', options: ['default' => false])]
    private bool $wouldGoAgain = false;

    #[ORM\Column(name: 'tips', type: Types::TEXT, nullable: true)]
    private ?string $tips = null;

    #[ORM\Column(name: 'currency', type: 'string', length: 8, options: ['default' => 'TND'])]
    #[Assert\NotBlank]
    #[Assert\Length(max: 8)]
    private string $currency = 'TND';

    #[ORM\Column(name: 'total_budget', type: 'decimal', precision: 10, scale: 2, nullable: true)]
    #[Assert\PositiveOrZero]
    private ?string $totalBudget = null;

    #[ORM\Column(name: 'budget_json', type: Types::JSON, nullable: true)]
    private ?array $budgetJson = [];

    #[ORM\Column(name: 'tags_json', type: Types::JSON, nullable: true)]
    private ?array $tagsJson = [];

    #[ORM\Column(name: 'must_visit_json', type: Types::JSON, nullable: true)]
    private ?array $mustVisitJson = [];

    #[ORM\Column(name: 'must_do_json', type: Types::JSON, nullable: true)]
    private ?array $mustDoJson = [];

    #[ORM\Column(name: 'must_try_json', type: Types::JSON, nullable: true)]
    private ?array $mustTryJson = [];

    #[ORM\Column(name: 'favorite_places_json', type: Types::JSON, nullable: true)]
    private ?array $favoritePlacesJson = [];

    #[ORM\Column(name: 'destination', type: 'string', length: 255, nullable: true)]
    private ?string $destination = null;

    #[ORM\Column(name: 'cover_image_url', type: 'string', length: 500, nullable: true)]
    #[Assert\Length(max: 500)]
    private ?string $coverImageUrl = null;

    #[ORM\Column(name: 'image_urls_json', type: Types::JSON, nullable: true)]
    private ?array $imageUrlsJson = [];

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(name: 'updated_at', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->wouldRecommend = true;
        $this->wouldGoAgain = false;
        $this->currency = 'TND';
        $this->createdAt = new \DateTime();
        $this->budgetJson = [];
        $this->tagsJson = [];
        $this->mustVisitJson = [];
        $this->mustDoJson = [];
        $this->mustTryJson = [];
        $this->favoritePlacesJson = [];
        $this->imageUrlsJson = [];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): static
    {
        $this->userId = $userId;
        return $this;
    }

    public function getDestinationId(): ?string
    {
        return $this->destinationId;
    }

    public function setDestinationId(?string $destinationId): static
    {
        $this->destinationId = $destinationId;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): static
    {
        $this->summary = $summary;
        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function getTravelType(): ?string
    {
        return $this->travelType;
    }

    public function setTravelType(?string $travelType): static
    {
        $this->travelType = $travelType;
        return $this;
    }

    public function getTravelStyle(): ?string
    {
        return $this->travelStyle;
    }

    public function setTravelStyle(?string $travelStyle): static
    {
        $this->travelStyle = $travelStyle;
        return $this;
    }

    public function getOverallRating(): ?int
    {
        return $this->overallRating;
    }

    public function setOverallRating(?int $overallRating): static
    {
        $this->overallRating = $overallRating;
        return $this;
    }

    public function isWouldRecommend(): bool
    {
        return $this->wouldRecommend;
    }

    public function setWouldRecommend(bool $wouldRecommend): static
    {
        $this->wouldRecommend = $wouldRecommend;
        return $this;
    }

    public function isWouldGoAgain(): bool
    {
        return $this->wouldGoAgain;
    }

    public function setWouldGoAgain(bool $wouldGoAgain): static
    {
        $this->wouldGoAgain = $wouldGoAgain;
        return $this;
    }

    public function getTips(): ?string
    {
        return $this->tips;
    }

    public function setTips(?string $tips): static
    {
        $this->tips = $tips;
        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;
        return $this;
    }

    public function getTotalBudget(): ?string
    {
        return $this->totalBudget;
    }

    public function setTotalBudget(?string $totalBudget): static
    {
        $this->totalBudget = $totalBudget;
        return $this;
    }

    public function getBudgetJson(): ?array
    {
        return $this->budgetJson;
    }

    public function setBudgetJson(?array $budgetJson): static
    {
        $this->budgetJson = $budgetJson;
        return $this;
    }

    public function getTagsJson(): ?array
    {
        return $this->tagsJson;
    }

    public function setTagsJson(?array $tagsJson): static
    {
        $this->tagsJson = $tagsJson;
        return $this;
    }

    public function getMustVisitJson(): ?array
    {
        return $this->mustVisitJson;
    }

    public function setMustVisitJson(?array $mustVisitJson): static
    {
        $this->mustVisitJson = $mustVisitJson;
        return $this;
    }

    public function getMustDoJson(): ?array
    {
        return $this->mustDoJson;
    }

    public function setMustDoJson(?array $mustDoJson): static
    {
        $this->mustDoJson = $mustDoJson;
        return $this;
    }

    public function getMustTryJson(): ?array
    {
        return $this->mustTryJson;
    }

    public function setMustTryJson(?array $mustTryJson): static
    {
        $this->mustTryJson = $mustTryJson;
        return $this;
    }

    public function getFavoritePlacesJson(): ?array
    {
        return $this->favoritePlacesJson;
    }

    public function setFavoritePlacesJson(?array $favoritePlacesJson): static
    {
        $this->favoritePlacesJson = $favoritePlacesJson;
        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(?string $destination): static
    {
        $this->destination = $destination;
        return $this;
    }

    public function getCoverImageUrl(): ?string
    {
        return $this->coverImageUrl;
    }

    public function setCoverImageUrl(?string $coverImageUrl): static
    {
        $this->coverImageUrl = $coverImageUrl;
        return $this;
    }

    public function getImageUrlsJson(): ?array
    {
        return $this->imageUrlsJson;
    }

    public function setImageUrlsJson(?array $imageUrlsJson): static
    {
        $this->imageUrlsJson = $imageUrlsJson;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}