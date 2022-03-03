<?php

namespace App\Entity;

use App\Repository\GestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GestionRepository::class)
 */
class Calendar
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $NomMatiere;

    /**
     * @ORM\Column(type="datetime",unique=true)
     */
    private $Debut;

    /**
     * @ORM\Column(type="datetime",unique=true)
     */
    private $Fin;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $CouleurDeFond;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $CouleurDuTexte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMatiere(): ?string
    {
        return $this->NomMatiere;
    }

    public function setNomMatiere( $NomMatiere): self
    {
        $this->title = $NomMatiere;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->Debut;
    }

    public function setDebut(\DateTimeInterface $Debut): self
    {
        $this->Debut = $Debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->Fin;
    }

    public function setFin(\DateTimeInterface $Fin): self
    {
        $this->Fin = $Fin;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }


    public function getCouleurDeFond(): ?string
    {
        return $this->CouleurDeFond;
    }

    public function setCouleurDeFond(string $CouleurDeFond): self
    {
        $this->CouleurDeFond = $CouleurDeFond;

        return $this;
    }

    public function getCouleurDuTexte(): ?string
    {
        return $this->CouleurDuTexte;
    }

    public function setCouleurDuTexte(string $CouleurDuTexte): self
    {
        $this->CouleurDuTexte = $CouleurDuTexte;

        return $this;
    }
}
