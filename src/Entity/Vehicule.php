<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 100)]
    private ?string $immatriculation = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(type: Types::BLOB)]
    private $image = null;

    #[ORM\Column]
    private ?int $anneeMiseEnCirculation = null;

    #[ORM\Column]
    private ?int $kms = null;

    #[ORM\Column]
    private ?bool $estDisponible = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): static
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getAnneeMiseEnCirculation(): ?int
    {
        return $this->anneeMiseEnCirculation;
    }

    public function setAnneeMiseEnCirculation(int $anneeMiseEnCirculation): static
    {
        $this->anneeMiseEnCirculation = $anneeMiseEnCirculation;

        return $this;
    }

    public function getKms(): ?int
    {
        return $this->kms;
    }

    public function setKms(int $kms): static
    {
        $this->kms = $kms;

        return $this;
    }

    public function isEstDisponible(): ?bool
    {
        return $this->estDisponible;
    }

    public function setEstDisponible(bool $estDisponible): static
    {
        $this->estDisponible = $estDisponible;

        return $this;
    }
    public function __toString() {
        return $this->libelle;
    }
}
