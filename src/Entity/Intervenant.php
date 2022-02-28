<?php

namespace App\Entity;

use App\Repository\IntervenantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IntervenantRepository::class)
 */
class Intervenant
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
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Identifiant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Mail;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $Droit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Mdp;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $Total_Heure;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $Total_Restantes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->Nom;
    }

    public function setNom($Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->Prenom;
    }

    public function setPrenom($Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getIdentifiant(): ?string
    {
        return $this->Identifiant;
    }

    public function setIdentifiant(string $Identifiant): self
    {
        $this->Identifiant = $Identifiant;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(string $Mail): self
    {
        $this->Mail = $Mail;

        return $this;
    }

    public function getDroit(): ?string
    {
        return $this->Droit;
    }

    public function setDroit(string $Droit): self
    {
        $this->Droit = $Droit;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->Mdp;
    }

    public function setMdp(string $Mdp): self
    {
        $this->Mdp = $Mdp;

        return $this;
    }

    public function getTotalHeure(): ?string
    {
        return $this->Total_Heure;
    }

    public function setTotalHeure(string $Total_Heure): self
    {
        $this->Total_Heure = $Total_Heure;

        return $this;
    }

    public function getTotalRestantes(): ?string
    {
        return $this->Total_Restantes;
    }

    public function setTotalRestantes(string $Total_Restantes): self
    {
        $this->Total_Restantes = $Total_Restantes;

        return $this;
    }

}
