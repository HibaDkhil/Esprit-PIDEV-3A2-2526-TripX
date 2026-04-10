<?php

namespace App\Entity;

use App\Repository\ReactionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReactionRepository::class)]
#[ORM\Table(name: 'reactions')]
class Reaction
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

    #[ORM\Column(nullable: true)]
    private ?int $comment_id = null;

    #[ORM\Column(length: 20)]
    private ?string $type = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getPostId(): ?int
    {
        return $this->post_id;
    }

    public function setPostId(?int $post_id): static
    {
        $this->post_id = $post_id;
        return $this;
    }

    public function getTravelStoryId(): ?int
    {
        return $this->travel_story_id;
    }

    public function setTravelStoryId(?int $travel_story_id): static
    {
        $this->travel_story_id = $travel_story_id;
        return $this;
    }

    public function getCommentId(): ?int
    {
        return $this->comment_id;
    }

    public function setCommentId(?int $comment_id): static
    {
        $this->comment_id = $comment_id;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;
        return $this;
    }
}