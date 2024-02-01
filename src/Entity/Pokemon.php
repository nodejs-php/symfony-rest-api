<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
#[Broadcast]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $name = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(nullable: true)]
    private ?int $sort = null;

    #[ORM\Column(length: 10)]
    private ?int $shape = null;

    #[ORM\Column(nullable: true)]
    private ?string $location = null;

    #[ORM\ManyToOne(targetEntity: Ability::class, inversedBy: 'abilities')]
    private ?string $ability = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(?int $sort): static
    {
        $this->sort = $sort;

        return $this;
    }

    public function getShape(): ?string
    {
        return $this->shape;
    }

    public function setShape(string $shape): static
    {
        $this->shape = $shape;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getAbility(): ?string
    {
        return $this->ability;
    }

    public function setAbility(?Ability $ability): self
    {
        $this->ability = $ability;

        return $this;
    }
}
