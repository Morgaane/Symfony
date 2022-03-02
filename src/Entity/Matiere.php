<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatiereRepository::class)
 */
class Matiere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomIntervenant;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $NomMatiere;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $TotalHeures;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private ?int $HeuresRestantes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomIntervenant(): ?string
    {
        return $this->NomIntervenant;
    }

    public function setNomIntervenant(string $NomIntervenant): self
    {
        $this->NomIntervenant = $NomIntervenant;

        return $this;
    }

    public function getNomMatiere(): ?string
    {
        return $this->NomMatiere;
    }

    public function setNomMatiere(string $NomMatiere): self
    {
        $this->NomMatiere = $NomMatiere;

        return $this;
    }

    public function getTotalHeures(): ?string
    {
        return $this->TotalHeures;
    }

    public function setTotalHeures(string $TotalHeures): self
    {
        $this->TotalHeures = $TotalHeures;

        return $this;
    }

    public function getHeuresRestantes(): ?string
    {
        return $this->HeuresRestantes;
    }

    public function setHeuresRestantes(string $HeuresRestantes): self
    {
        $this->HeuresRestantes = $HeuresRestantes;

        return $this;
    }

}
