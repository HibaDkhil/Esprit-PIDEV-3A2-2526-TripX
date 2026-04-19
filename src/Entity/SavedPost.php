<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'saved_posts')]
class SavedPost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'user_id', type: 'integer')]
    private ?int $user_id = null;

    #[ORM\Column(name: 'post_id', type: 'integer')]
    private ?int $post_id = null;

    #[ORM\Column(name: 'saved_at', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $saved_at = null;

    public function getId(): ?int { return $this->id; }

    public function getUserId(): ?int { return $this->user_id; }
    public function setUserId(int $user_id): static { $this->user_id = $user_id; return $this; }

    public function getPostId(): ?int { return $this->post_id; }
    public function setPostId(int $post_id): static { $this->post_id = $post_id; return $this; }

    public function getSavedAt(): ?\DateTimeInterface { return $this->saved_at; }
    public function setSavedAt(?\DateTimeInterface $saved_at): static { $this->saved_at = $saved_at; return $this; }
}