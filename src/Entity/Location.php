<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
#[Broadcast]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "SEQUENCE")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: Location::class, inversedBy: 'locations')]
    private ?int $parent= null;

    #[ORM\Column(name: "created_at", type: "datetime", nullable: true)]
    private DateTimeInterface|null $createdAt = null;

    public function __construct() {
    }

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

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }
}
