<?php

namespace App\Entity;

use App\Repository\StoryRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: StoryRepository::class)]
#[ORM\Table(name: 'stories')]
class Story
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    // Relation instead of user_id int
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'user_id', nullable: false)]
    private ?User $user = null;

    #[ORM\Column(name: 'image_url', type: 'string', length: 500)]
    private ?string $imageUrl = null;

    #[ORM\Column(name: 'caption', type: 'string', length: 255, nullable: true)]
    private ?string $caption = null;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(name: 'expires_at', type: 'datetime')]
    private ?\DateTimeInterface $expiresAt = null;

    #[ORM\Column(name: 'removed_by_admin', type: 'boolean', options: ['default' => false])]
    private bool $removedByAdmin = false;

    #[ORM\Column(name: 'removal_reason', type: Types::TEXT, nullable: true)]
    private ?string $removalReason = null;

    #[ORM\Column(name: 'removed_at', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $removedAt = null;

    // ===== GETTERS / SETTERS =====

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getUserId(): ?int
    {
        return $this->user?->getUserId();
    }

    public function setUser(User $user): static
    {
        $this->user = $user;
        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(?string $caption): static
    {
        $this->caption = $caption;
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

    public function getExpiresAt(): ?\DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(\DateTimeInterface $expiresAt): static
    {
        $this->expiresAt = $expiresAt;
        return $this;
    }

    public function isExpired(?\DateTimeInterface $at = null): bool
    {
        $at = $at ?? new \DateTimeImmutable();

        return $this->expiresAt instanceof \DateTimeInterface
            ? $this->expiresAt <= $at
            : true;
    }

    public function isRemovedByAdmin(): bool
    {
        return $this->removedByAdmin;
    }

    public function setRemovedByAdmin(bool $removedByAdmin): static
    {
        $this->removedByAdmin = $removedByAdmin;
        return $this;
    }

    public function getRemovalReason(): ?string
    {
        return $this->removalReason;
    }

    public function setRemovalReason(?string $removalReason): static
    {
        $this->removalReason = $removalReason;
        return $this;
    }

    public function getRemovedAt(): ?\DateTimeInterface
    {
        return $this->removedAt;
    }

    private function setRemovedAt(?\DateTimeInterface $removedAt): static
    {
        $this->removedAt = $removedAt;
        return $this;
    }

    public function softDelete(?string $reason = null, bool $removedByAdmin = true): static
    {
        $this->removedByAdmin = $removedByAdmin;
        $this->removalReason = $reason;
        $this->setRemovedAt(new \DateTimeImmutable());

        return $this;
    }

    public function restore(): static
    {
        $this->removedByAdmin = false;
        $this->removalReason = null;
        $this->setRemovedAt(null);

        return $this;
    }
}
