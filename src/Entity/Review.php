<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\ReviewRepository;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[ORM\Table(name: 'reviews')]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'review_id', type: 'bigint')]
    private ?string $reviewId = null;

    #[ORM\Column(name: 'destination_id', type: 'bigint')]
    private ?string $destinationId = null;

    #[ORM\Column(name: 'user_id', type: 'integer')]
    private ?int $userId = null;

    #[ORM\Column(type: 'smallint')]
    #[Assert\NotBlank(message: 'Please select a rating.')]
    #[Assert\Range(min: 1, max: 5, notInRangeMessage: 'Rating must be between {{ min }} and {{ max }} stars.')]
    private ?int $rating = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: 'Please write a comment.')]
    #[Assert\Length(
        min: 10,
        max: 2000,
        minMessage: 'Your comment must be at least {{ limit }} characters.',
        maxMessage: 'Your comment cannot exceed {{ limit }} characters.'
    )]
    private ?string $comment = null;

    #[ORM\Column(name: 'created_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getReviewId(): ?string { return $this->reviewId; }
    public function getId(): ?string { return $this->reviewId; }

    public function getDestinationId(): ?string { return $this->destinationId; }
    public function setDestinationId(?string $destinationId): static { $this->destinationId = $destinationId; return $this; }

    public function getUserId(): ?int { return $this->userId; }
    public function setUserId(?int $userId): static { $this->userId = $userId; return $this; }

    public function getRating(): ?int { return $this->rating; }
    public function setRating(?int $rating): static { $this->rating = $rating; return $this; }

    public function getComment(): ?string { return $this->comment; }
    public function setComment(?string $comment): static { $this->comment = $comment; return $this; }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): static { $this->createdAt = $createdAt; return $this; }
}
