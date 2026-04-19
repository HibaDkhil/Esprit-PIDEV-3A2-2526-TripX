<?php

namespace App\Entity;

use App\Repository\ShareRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShareRepository::class)]
#[ORM\Table(name: 'shares')]
class Share
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $post_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $travel_story_id = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    public function getId(): ?int { return $this->id; }

    public function getUserId(): ?int { return $this->user_id; }
    public function setUserId(int $user_id): static {
        $this->user_id = $user_id;
        return $this;
    }

    public function getPostId(): ?int { return $this->post_id; }
    public function setPostId(?int $post_id): static {
        $this->post_id = $post_id;
        return $this;
    }

    public function getTravelStoryId(): ?int { return $this->travel_story_id; }
    public function setTravelStoryId(?int $travel_story_id): static {
        $this->travel_story_id = $travel_story_id;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->created_at; }
    public function setCreatedAt(?\DateTimeInterface $created_at): static {
        $this->created_at = $created_at;
        return $this;
    }
}