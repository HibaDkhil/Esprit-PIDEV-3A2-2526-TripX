<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
#[ORM\Table(name: 'comments')]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(name: 'post_id', referencedColumnName: 'id', nullable: true)]
    private ?Post $post = null;

    #[ORM\Column(name: 'travel_story_id', type: 'integer', nullable: true)]
    private ?int $travel_story_id = null;

    #[ORM\Column(name: 'user_id', type: 'integer')]
    private ?int $user_id = null;

    #[ORM\Column(name: 'parent_comment_id', type: 'integer', nullable: true)]
    private ?int $parent_comment_id = null;

    #[ORM\Column(name: 'body', type: Types::TEXT)]
    private ?string $body = null;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): static
    {
        $this->post = $post;
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

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getParentCommentId(): ?int
    {
        return $this->parent_comment_id;
    }

    public function setParentCommentId(?int $parent_comment_id): static
    {
        $this->parent_comment_id = $parent_comment_id;
        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): static
    {
        $this->body = $body;
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