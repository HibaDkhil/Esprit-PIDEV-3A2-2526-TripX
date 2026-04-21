<?php

namespace App\Entity;

use App\Repository\BlogNotificationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogNotificationRepository::class)]
#[ORM\Table(name: 'blog_notifications')]
#[ORM\Index(columns: ['user_id'], name: 'IDX_blog_notif_user')]
class BlogNotification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** The user who should receive this notification */
    #[ORM\Column]
    private int $userId;

    /** moderation | warning | info */
    #[ORM\Column(length: 40)]
    private string $type = 'moderation';

    #[ORM\Column(type: 'text')]
    private string $message;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $isRead = false;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private \DateTimeInterface $createdAt;

    public function __construct(int $userId, string $message, string $type = 'moderation')
    {
        $this->userId    = $userId;
        $this->message   = $message;
        $this->type      = $type;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function isRead(): bool
    {
        return $this->isRead;
    }

    public function markRead(): static
    {
        $this->isRead = true;
        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }
}
