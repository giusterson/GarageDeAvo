<?php

namespace App\Entity;

use App\Repository\ReparationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReparationRepository::class)]
class Reparation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column]
    private ?int $prixMoyen = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $nomReparation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getPrixMoyen(): ?int
    {
        return $this->prixMoyen;
    }

    public function setPrixMoyen(int $prixMoyen): static
    {
        $this->prixMoyen = $prixMoyen;

        return $this;
    }

    public function getNomReparation(): ?string
    {
        return $this->nomReparation;
    }

    public function setNomReparation(string $nomReparation): static
    {
        $this->nomReparation = $nomReparation;

        return $this;
    }
}
