<?php

namespace App\Entity;

use App\Repository\StoryViewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StoryViewRepository::class)]
#[ORM\Table(name: 'story_views')]
#[ORM\UniqueConstraint(name: 'uniq_story_view', columns: ['story_id', 'viewer_id'])]
class StoryView
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Story::class)]
    #[ORM\JoinColumn(name: 'story_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?Story $story = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'viewer_id', referencedColumnName: 'user_id', nullable: false, onDelete: 'CASCADE')]
    private ?User $viewer = null;

    #[ORM\Column(name: 'seen_at', type: 'datetime')]
    private ?\DateTimeInterface $seenAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStory(): ?Story
    {
        return $this->story;
    }

    public function setStory(Story $story): static
    {
        $this->story = $story;

        return $this;
    }

    public function getViewer(): ?User
    {
        return $this->viewer;
    }

    public function setViewer(User $viewer): static
    {
        $this->viewer = $viewer;

        return $this;
    }

    public function getSeenAt(): ?\DateTimeInterface
    {
        return $this->seenAt;
    }

    public function setSeenAt(\DateTimeInterface $seenAt): static
    {
        $this->seenAt = $seenAt;

        return $this;
    }
}
