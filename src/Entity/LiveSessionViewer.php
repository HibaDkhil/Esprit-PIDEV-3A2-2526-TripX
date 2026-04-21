<?php

namespace App\Entity;

use App\Repository\LiveSessionViewerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LiveSessionViewerRepository::class)]
#[ORM\Table(name: 'live_session_viewers')]
class LiveSessionViewer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: LiveSession::class, inversedBy: 'viewers')]
    #[ORM\JoinColumn(name: 'live_session_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?LiveSession $liveSession = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'viewer_user_id', referencedColumnName: 'user_id', nullable: false, onDelete: 'CASCADE')]
    private ?User $viewerUser = null;

    #[ORM\Column(name: 'joined_at', type: 'datetime')]
    private ?\DateTimeInterface $joinedAt = null;

    #[ORM\Column(name: 'left_at', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $leftAt = null;

    #[ORM\Column(name: 'is_active', type: 'boolean')]
    private bool $isActive = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLiveSession(): ?LiveSession
    {
        return $this->liveSession;
    }

    public function setLiveSession(?LiveSession $liveSession): self
    {
        $this->liveSession = $liveSession;
        return $this;
    }

    public function getViewerUser(): ?User
    {
        return $this->viewerUser;
    }

    public function setViewerUser(?User $viewerUser): self
    {
        $this->viewerUser = $viewerUser;
        return $this;
    }

    public function getJoinedAt(): ?\DateTimeInterface
    {
        return $this->joinedAt;
    }

    public function setJoinedAt(\DateTimeInterface $joinedAt): self
    {
        $this->joinedAt = $joinedAt;
        return $this;
    }

    public function getLeftAt(): ?\DateTimeInterface
    {
        return $this->leftAt;
    }

    public function setLeftAt(?\DateTimeInterface $leftAt): self
    {
        $this->leftAt = $leftAt;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }
}