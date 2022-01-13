<?php

namespace App\Entity;

use App\Repository\ChatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChatRepository::class)
 */
class Chat
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
    private $Id_User;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Date_Msg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Contenu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?string
    {
        return $this->Id_User;
    }

    public function setIdUser(string $Id_User): self
    {
        $this->Id_User = $Id_User;

        return $this;
    }

    public function getDateMsg(): ?string
    {
        return $this->Date_Msg;
    }

    public function setDateMsg(string $Date_Msg): self
    {
        $this->Date_Msg = $Date_Msg;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->Contenu;
    }

    public function setContenu(string $Contenu): self
    {
        $this->Contenu = $Contenu;

        return $this;
    }
}
