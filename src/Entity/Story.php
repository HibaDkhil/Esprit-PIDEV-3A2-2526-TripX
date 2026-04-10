<?php

namespace App\Entity;

use App\Repository\StoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StoryRepository::class)]
#[ORM\Table(name: 'stories')]
class Story
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column(length: 500)]
    private ?string $image_url = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $caption = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $expires_at = null;

    public function getId(): ?int { return $this->id; }

    public function getUserId(): ?int { return $this->user_id; }
    public function setUserId(int $user_id): static {
        $this->user_id = $user_id;
        return $this;
    }

    public function getImageUrl(): ?string { return $this->image_url; }
    public function setImageUrl(string $image_url): static {
        $this->image_url = $image_url;
        return $this;
    }

    public function getCaption(): ?string { return $this->caption; }
    public function setCaption(?string $caption): static {
        $this->caption = $caption;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->created_at; }
    public function setCreatedAt(\DateTimeInterface $created_at): static {
        $this->created_at = $created_at;
        return $this;
    }

    public function getExpiresAt(): ?\DateTimeInterface { return $this->expires_at; }
    public function setExpiresAt(\DateTimeInterface $expires_at): static {
        $this->expires_at = $expires_at;
        return $this;
    }
}