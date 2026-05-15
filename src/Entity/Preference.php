<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'userpreferences')]
class Preference
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'preference_id', type: 'integer')]
    private ?int $preferenceId = null;

    #[ORM\Column(name: 'user_id', type: 'integer')]
    private ?int $userId = null;

    #[ORM\Column(name: 'budget_min_per_night', type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?string $budgetMinPerNight = null;

    #[ORM\Column(name: 'budget_max_per_night', type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?string $budgetMaxPerNight = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $priorities = null;

    #[ORM\Column(name: 'location_preferences', type: 'text', nullable: true)]
    private ?string $locationPreferences = null;

    #[ORM\Column(name: 'accommodation_types', type: 'text', nullable: true)]
    private ?string $accommodationTypes = null;

    #[ORM\Column(name: 'style_preferences', type: 'text', nullable: true)]
    private ?string $stylePreferences = null;

    #[ORM\Column(name: 'dietary_restrictions', type: 'text', nullable: true)]
    private ?string $dietaryRestrictions = null;

    #[ORM\Column(name: 'preferred_climate', type: 'text', nullable: true)]
    private ?string $preferredClimate = null;

    // Changed from enum to string
    #[ORM\Column(name: 'travel_pace', type: 'string', length: 30, nullable: true, options: ['default' => 'Moderate'])]
    private ?string $travelPace = null;

    // Changed from enum to string
    #[ORM\Column(name: 'group_type', type: 'string', length: 30, nullable: true)]
    private ?string $groupType = null;

    #[ORM\Column(name: 'accessibility_needs', type: 'boolean', nullable: true, options: ['default' => false])]
    private ?bool $accessibilityNeeds = null;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(name: 'updated_at', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    /* ── Getters / Setters ── */

    public function getPreferenceId(): ?int { return $this->preferenceId; }

    public function getUserId(): ?int { return $this->userId; }
    public function setUserId(int $userId): static { $this->userId = $userId; return $this; }

    public function getBudgetMinPerNight(): ?float { return $this->budgetMinPerNight !== null ? (float) $this->budgetMinPerNight : null; }
    public function setBudgetMinPerNight(float|string|null $v): static { $this->budgetMinPerNight = $v !== null ? number_format((float) $v, 2, '.', '') : null; return $this; }

    public function getBudgetMaxPerNight(): ?float { return $this->budgetMaxPerNight !== null ? (float) $this->budgetMaxPerNight : null; }
    public function setBudgetMaxPerNight(float|string|null $v): static { $this->budgetMaxPerNight = $v !== null ? number_format((float) $v, 2, '.', '') : null; return $this; }

    public function getPriorities(): ?string { return $this->priorities; }
    public function setPriorities(?string $v): static { $this->priorities = $v; return $this; }

    public function getLocationPreferences(): ?string { return $this->locationPreferences; }
    public function setLocationPreferences(?string $v): static { $this->locationPreferences = $v; return $this; }

    public function getAccommodationTypes(): ?string { return $this->accommodationTypes; }
    public function setAccommodationTypes(?string $v): static { $this->accommodationTypes = $v; return $this; }

    public function getStylePreferences(): ?string { return $this->stylePreferences; }
    public function setStylePreferences(?string $v): static { $this->stylePreferences = $v; return $this; }

    public function getDietaryRestrictions(): ?string { return $this->dietaryRestrictions; }
    public function setDietaryRestrictions(?string $v): static { $this->dietaryRestrictions = $v; return $this; }

    public function getPreferredClimate(): ?string { return $this->preferredClimate; }
    public function setPreferredClimate(?string $v): static { $this->preferredClimate = $v; return $this; }

    public function getTravelPace(): ?string { return $this->travelPace; }
    public function setTravelPace(?string $v): static { $this->travelPace = $v; return $this; }

    public function getGroupType(): ?string { return $this->groupType; }
    public function setGroupType(?string $v): static { $this->groupType = $v; return $this; }

    public function getAccessibilityNeeds(): ?bool { return $this->accessibilityNeeds; }
    public function setAccessibilityNeeds(?bool $v): static { $this->accessibilityNeeds = $v; return $this; }

    public function getCreatedAt(): \DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): static { $this->createdAt = $createdAt; return $this; }

    public function getUpdatedAt(): ?\DateTimeInterface { return $this->updatedAt; }
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static { $this->updatedAt = $updatedAt; return $this; }
}
