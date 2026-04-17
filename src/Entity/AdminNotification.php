<?php

namespace App\Entity;

use App\Repository\AdminNotificationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminNotificationRepository::class)]
#[ORM\Table(name: 'admin_notifications')]
class AdminNotification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'text')]
    private ?string $message = null;

    #[ORM\Column(length: 50)]
    private ?string $type = 'booking';

    #[ORM\Column]
    private ?bool $isRead = false;

    #[ORM\Column]
    private ?int $relatedId = null;

    #[ORM\Column(length: 50)]
    private ?string $relatedType = 'booking';

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->isRead = false;
    }

    public function getId(): ?int { return $this->id; }
    public function getTitle(): ?string { return $this->title; }
    public function setTitle(string $title): static { $this->title = $title; return $this; }
    public function getMessage(): ?string { return $this->message; }
    public function setMessage(string $message): static { $this->message = $message; return $this; }
    public function getType(): ?string { return $this->type; }
    public function setType(string $type): static { $this->type = $type; return $this; }
    public function isRead(): ?bool { return $this->isRead; }
    public function setIsRead(bool $isRead): static { $this->isRead = $isRead; return $this; }
    public function getRelatedId(): ?int { return $this->relatedId; }
    public function setRelatedId(int $relatedId): static { $this->relatedId = $relatedId; return $this; }
    public function getRelatedType(): ?string { return $this->relatedType; }
    public function setRelatedType(string $relatedType): static { $this->relatedType = $relatedType; return $this; }
    public function getCreatedAt(): ?\DateTimeImmutable { return $this->createdAt; }
}