<?php

namespace App\Entity;

use App\Repository\FollowingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FollowingRepository::class)]
#[ORM\Table(name: 'followings')]
class Following
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $follower_id = null;

    #[ORM\Column]
    private ?int $followed_id = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    public function getId(): ?int { return $this->id; }

    public function getFollowerId(): ?int { return $this->follower_id; }
    public function setFollowerId(int $follower_id): static {
        $this->follower_id = $follower_id;
        return $this;
    }

    public function getFollowedId(): ?int { return $this->followed_id; }
    public function setFollowedId(int $followed_id): static {
        $this->followed_id = $followed_id;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->created_at; }
    public function setCreatedAt(?\DateTimeInterface $created_at): static {
        $this->created_at = $created_at;
        return $this;
    }
}