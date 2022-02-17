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
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $ID_Intervenant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom_Matiere;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $Total_Heures;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $Heures_Restantes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDIntervenant(): ?string
    {
        return $this->ID_Intervenant;
    }

    public function setIDIntervenant(string $ID_Intervenant): self
    {
        $this->ID_Intervenant = $ID_Intervenant;

        return $this;
    }

    public function getNomMatiere(): ?string
    {
        return $this->Nom_Matiere;
    }

    public function setNomMatiere(string $Nom_Matiere): self
    {
        $this->Nom_Matiere = $Nom_Matiere;

        return $this;
    }

    public function getTotalHeures(): ?string
    {
        return $this->Total_Heures;
    }

    public function setTotalHeures(string $Total_Heures): self
    {
        $this->Total_Heures = $Total_Heures;

        return $this;
    }

    public function getHeuresRestantes(): ?string
    {
        return $this->Heures_Restantes;
    }

    public function setHeuresRestantes(string $Heures_Restantes): self
    {
        $this->Heures_Restantes = $Heures_Restantes;

        return $this;
    }
}
