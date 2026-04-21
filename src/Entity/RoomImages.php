<?php

namespace App\Entity;

use App\Repository\RoomImagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomImagesRepository::class)]
#[ORM\Table(name: 'room_images')]
class RoomImages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Room::class)]
    #[ORM\JoinColumn(name: 'room_id', referencedColumnName: 'id', nullable: false)]
    private ?Room $room = null;

    #[ORM\Column(name: 'file_name', type: 'string', length: 255)]
    private ?string $fileName = null;

    #[ORM\Column(name: 'file_path', type: 'string', length: 1024)]
    private ?string $filePath = null;

    #[ORM\Column(name: 'mime_type', type: 'string', length: 100, nullable: true)]
    private ?string $mimeType = null;

    #[ORM\Column(name: 'file_size_bytes', type: 'bigint', nullable: true, options: ['unsigned' => true])]
    private ?string $fileSizeBytes = null;

    #[ORM\Column(type: 'integer', nullable: true, options: ['unsigned' => true])]
    private ?int $width = null;

    #[ORM\Column(type: 'integer', nullable: true, options: ['unsigned' => true])]
    private ?int $height = null;

    #[ORM\Column(name: 'is_primary', type: 'boolean', options: ['default' => false])]
    private ?bool $isPrimary = false;

    #[ORM\Column(name: 'display_order', type: 'integer', options: ['default' => 0])]
    private ?int $displayOrder = 0;

    #[ORM\Column(name: 'created_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(name: 'updated_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $updatedAt = null;

    // ─── Getters & Setters ───────────────────────────

    public function getId(): ?int { return $this->id; }

    public function getRoom(): ?Room { return $this->room; }
    public function setRoom(?Room $room): static { $this->room = $room; return $this; }

    public function getFileName(): ?string { return $this->fileName; }
    public function setFileName(string $fileName): static { $this->fileName = $fileName; return $this; }

    public function getFilePath(): ?string { return $this->filePath; }
    public function setFilePath(string $filePath): static { $this->filePath = $filePath; return $this; }

    public function getMimeType(): ?string { return $this->mimeType; }
    public function setMimeType(?string $mimeType): static { $this->mimeType = $mimeType; return $this; }

    public function getFileSizeBytes(): ?string { return $this->fileSizeBytes; }
    public function setFileSizeBytes(?string $fileSizeBytes): static { $this->fileSizeBytes = $fileSizeBytes; return $this; }

    public function getWidth(): ?int { return $this->width; }
    public function setWidth(?int $width): static { $this->width = $width; return $this; }

    public function getHeight(): ?int { return $this->height; }
    public function setHeight(?int $height): static { $this->height = $height; return $this; }

    public function isPrimary(): ?bool { return $this->isPrimary; }
    public function setIsPrimary(bool $isPrimary): static { $this->isPrimary = $isPrimary; return $this; }

    public function getDisplayOrder(): ?int { return $this->displayOrder; }
    public function setDisplayOrder(int $displayOrder): static { $this->displayOrder = $displayOrder; return $this; }

    public function getCreatedAt(): ?\DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): static { $this->createdAt = $createdAt; return $this; }

    public function getUpdatedAt(): ?\DateTimeInterface { return $this->updatedAt; }
    public function setUpdatedAt(\DateTimeInterface $updatedAt): static { $this->updatedAt = $updatedAt; return $this; }
}
