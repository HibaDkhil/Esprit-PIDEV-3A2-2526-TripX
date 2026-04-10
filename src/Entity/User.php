<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: 'user')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'user_id', type: 'integer')]
    private ?int $userId = null;

    #[ORM\Column(name: 'first_name', type: 'string', length: 80)]
    private ?string $firstName = null;

    #[ORM\Column(name: 'last_name', type: 'string', length: 80)]
    private ?string $lastName = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'string')]
    private ?string $password = null;

    #[ORM\Column(name: 'phone_number', type: 'string', length: 30, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column(type: 'string', length: 20, options: ['default' => 'user'])]
    private string $role = 'user';

    #[ORM\Column(type: 'string', length: 30, options: ['default' => 'pending_verification'])]
    private string $status = 'pending_verification';

    #[ORM\Column(name: 'email_verified', type: 'boolean', options: ['default' => false])]
    private bool $emailVerified = false;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private ?string $gender = null;

    #[ORM\Column(name: 'birth_year', type: 'string', length: 20, nullable: true)]
    private ?string $birthYear = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $bio = null;

    #[ORM\Column(name: 'avatar_id', type: 'integer', nullable: true)]
    private ?int $avatarId = null;

    #[ORM\Column(name: 'created_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(name: 'updated_at', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private \DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /* ── Getters / Setters ── */

    public function getId(): ?int { return $this->userId; }
    public function getUserId(): ?int { return $this->userId; }

    public function getFirstName(): ?string { return $this->firstName; }
    public function setFirstName(string $firstName): static { $this->firstName = $firstName; return $this; }

    public function getLastName(): ?string { return $this->lastName; }
    public function setLastName(string $lastName): static { $this->lastName = $lastName; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): static { $this->email = $email; return $this; }

    public function getPassword(): ?string { return $this->password; }
    public function setPassword(string $password): static { $this->password = $password; return $this; }

    public function getPhoneNumber(): ?string { return $this->phoneNumber; }
    public function setPhoneNumber(?string $phoneNumber): static { $this->phoneNumber = $phoneNumber; return $this; }

    public function getRole(): string { return $this->role; }
    public function setRole(string $role): static { $this->role = $role; return $this; }

    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): static { $this->status = $status; return $this; }

    public function isEmailVerified(): bool { return $this->emailVerified; }
    public function setEmailVerified(bool $emailVerified): static { $this->emailVerified = $emailVerified; return $this; }

    public function getGender(): ?string { return $this->gender; }
    public function setGender(?string $gender): static { $this->gender = $gender; return $this; }

    public function getBirthYear(): ?string { return $this->birthYear; }
    public function setBirthYear(?string $birthYear): static { $this->birthYear = $birthYear; return $this; }

    public function getBio(): ?string { return $this->bio; }
    public function setBio(?string $bio): static { $this->bio = $bio; return $this; }

    public function getAvatarId(): ?int { return $this->avatarId; }
    public function setAvatarId(?int $avatarId): static { $this->avatarId = $avatarId; return $this; }

    public function getCreatedAt(): \DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt): static { $this->createdAt = $createdAt; return $this; }

    public function getUpdatedAt(): \DateTimeInterface { return $this->updatedAt; }
    public function setUpdatedAt(\DateTimeInterface $updatedAt): static { $this->updatedAt = $updatedAt; return $this; }

    /* ── UserInterface ── */

    public function getUserIdentifier(): string { return (string) $this->email; }

    public function getRoles(): array
    {
        $roles = ['ROLE_USER'];
        
        // Map the single "role" column to Symfony's ROLE_ format
        switch ($this->role) {
            case 'admin':
                $roles[] = 'ROLE_ADMIN';
                break;
            case 'adminDestination':
                $roles[] = 'ROLE_ADMIN_DESTINATION';
                break;
            case 'adminAccomodation':
                $roles[] = 'ROLE_ADMIN_ACCOMODATION';
                break;
            case 'adminOffers':
                $roles[] = 'ROLE_ADMIN_OFFERS';
                break;
            case 'adminBlog':
                $roles[] = 'ROLE_ADMIN_BLOG';
                break;
            case 'adminTransport':
                $roles[] = 'ROLE_ADMIN_TRANSPORT';
                break;
        }

        return array_unique($roles);
    }

    public function eraseCredentials(): void
    {
        // Clear any temporary sensitive data
    }
}
