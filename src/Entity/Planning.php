<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanningRepository::class)
 */
class Planning
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
    private $Id_Matiere;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $periode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Date_Debut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Date_Fin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMatiere(): ?string
    {
        return $this->Id_Matiere;
    }

    public function setIdMatiere(string $Id_Matiere): self
    {
        $this->Id_Matiere = $Id_Matiere;

        return $this;
    }

    public function getPeriode(): ?string
    {
        return $this->periode;
    }

    public function setPeriode(string $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getDateDebut(): ?string
    {
        return $this->Date_Debut;
    }

    public function setDateDebut(string $Date_Debut): self
    {
        $this->Date_Debut = $Date_Debut;

        return $this;
    }

    public function getDateFin(): ?string
    {
        return $this->Date_Fin;
    }

    public function setDateFin(string $Date_Fin): self
    {
        $this->Date_Fin = $Date_Fin;

        return $this;
    }
}
