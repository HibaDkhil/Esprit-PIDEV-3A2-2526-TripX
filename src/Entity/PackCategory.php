<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'pack_categories')]
class PackCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_category', type: 'integer')]
    private ?int $idCategory = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message: 'Category name is required.')]
    #[Assert\Length(min: 2, max: 100, minMessage: 'Name must be at least 2 characters.', maxMessage: 'Name cannot exceed 100 characters.')]
    private ?string $name = null;

    public function getId(): ?int { return $this->idCategory; }
    public function getIdCategory(): ?int { return $this->idCategory; }

    public function getName(): ?string { return $this->name; }
    public function setName(string $name): static { $this->name = $name; return $this; }
}
