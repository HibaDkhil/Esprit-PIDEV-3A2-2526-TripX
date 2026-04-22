<?php

namespace App\Entity;

use App\Repository\LiveSessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LiveSessionRepository::class)]
#[ORM\Table(name: 'live_sessions')]
class LiveSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'host_user_id', referencedColumnName: 'user_id', nullable: false, onDelete: 'CASCADE')]
    private ?User $hostUser = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 20)]
    private string $status = 'live';

    #[ORM\Column(name: 'room_name', length: 255)]
    private ?string $roomName = null;

    #[ORM\Column(name: 'stream_token', length: 500, nullable: true)]
    private ?string $streamToken = null;

    #[ORM\Column(name: 'thumbnail_url', length: 500, nullable: true)]
    private ?string $thumbnailUrl = null;

    #[ORM\Column(name: 'recording_url', length: 500, nullable: true)]
    private ?string $recordingUrl = null;

    #[ORM\Column(name: 'started_at', type: 'datetime')]
    private ?\DateTimeInterface $startedAt = null;

    #[ORM\Column(name: 'ended_at', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $endedAt = null;

    #[ORM\Column(name: 'saved_to_profile', type: 'boolean', options: ['default' => false])]
    private bool $savedToProfile = false;

    #[ORM\Column(name: 'saved_to_profile_at', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $savedToProfileAt = null;

    #[ORM\Column(name: 'removed_by_admin', type: 'boolean', options: ['default' => false])]
    private bool $removedByAdmin = false;

    #[ORM\Column(name: 'removal_reason', type: 'text', nullable: true)]
    private ?string $removalReason = null;

    #[ORM\Column(name: 'removed_at', type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $removedAt = null;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(name: 'updated_at', type: 'datetime')]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'liveSession', targetEntity: LiveComment::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'liveSession', targetEntity: LiveReaction::class, orphanRemoval: true)]
    private Collection $reactions;

    #[ORM\OneToMany(mappedBy: 'liveSession', targetEntity: LiveSessionViewer::class, orphanRemoval: true)]
    private Collection $viewers;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->reactions = new ArrayCollection();
        $this->viewers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHostUser(): ?User
    {
        return $this->hostUser;
    }

    public function setHostUser(?User $hostUser): self
    {
        $this->hostUser = $hostUser;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getRoomName(): ?string
    {
        return $this->roomName;
    }

    public function setRoomName(string $roomName): self
    {
        $this->roomName = $roomName;
        return $this;
    }

    public function getStreamToken(): ?string
    {
        return $this->streamToken;
    }

    public function setStreamToken(?string $streamToken): self
    {
        $this->streamToken = $streamToken;
        return $this;
    }

    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl(?string $thumbnailUrl): self
    {
        $this->thumbnailUrl = $thumbnailUrl;
        return $this;
    }

    public function getRecordingUrl(): ?string
    {
        return $this->recordingUrl;
    }

    public function setRecordingUrl(?string $recordingUrl): self
    {
        $this->recordingUrl = $recordingUrl;
        return $this;
    }

    public function getStartedAt(): ?\DateTimeInterface
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTimeInterface $startedAt): self
    {
        $this->startedAt = $startedAt;
        return $this;
    }

    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTimeInterface $endedAt): self
    {
        $this->endedAt = $endedAt;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function isSavedToProfile(): bool
    {
        return $this->savedToProfile;
    }

    public function setSavedToProfile(bool $savedToProfile): self
    {
        $this->savedToProfile = $savedToProfile;
        return $this;
    }

    public function getSavedToProfileAt(): ?\DateTimeInterface
    {
        return $this->savedToProfileAt;
    }

    public function setSavedToProfileAt(?\DateTimeInterface $savedToProfileAt): self
    {
        $this->savedToProfileAt = $savedToProfileAt;
        return $this;
    }

    public function isRemovedByAdmin(): bool
    {
        return $this->removedByAdmin;
    }

    public function setRemovedByAdmin(bool $removedByAdmin): self
    {
        $this->removedByAdmin = $removedByAdmin;
        return $this;
    }

    public function getRemovalReason(): ?string
    {
        return $this->removalReason;
    }

    public function setRemovalReason(?string $removalReason): self
    {
        $this->removalReason = $removalReason;
        return $this;
    }

    public function getRemovedAt(): ?\DateTimeInterface
    {
        return $this->removedAt;
    }

    public function setRemovedAt(?\DateTimeInterface $removedAt): self
    {
        $this->removedAt = $removedAt;
        return $this;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return Collection<int, LiveComment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(LiveComment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setLiveSession($this);
        }

        return $this;
    }

    public function removeComment(LiveComment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            if ($comment->getLiveSession() === $this) {
                $comment->setLiveSession(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LiveReaction>
     */
    public function getReactions(): Collection
    {
        return $this->reactions;
    }

    public function addReaction(LiveReaction $reaction): self
    {
        if (!$this->reactions->contains($reaction)) {
            $this->reactions->add($reaction);
            $reaction->setLiveSession($this);
        }

        return $this;
    }

    public function removeReaction(LiveReaction $reaction): self
    {
        if ($this->reactions->removeElement($reaction)) {
            if ($reaction->getLiveSession() === $this) {
                $reaction->setLiveSession(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LiveSessionViewer>
     */
    public function getViewers(): Collection
    {
        return $this->viewers;
    }

    public function addViewer(LiveSessionViewer $viewer): self
    {
        if (!$this->viewers->contains($viewer)) {
            $this->viewers->add($viewer);
            $viewer->setLiveSession($this);
        }

        return $this;
    }

    public function removeViewer(LiveSessionViewer $viewer): self
    {
        if ($this->viewers->removeElement($viewer)) {
            if ($viewer->getLiveSession() === $this) {
                $viewer->setLiveSession(null);
            }
        }

        return $this;
    }
}