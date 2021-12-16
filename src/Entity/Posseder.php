<?php

namespace App\Entity;

use App\Repository\PossederRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PossederRepository::class)
 */
class Posseder
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="posseders")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Livres::class, inversedBy="posseders")
     */
    private $livre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getLivre(): ?Livres
    {
        return $this->livre;
    }

    public function setLivre(?Livres $livre): self
    {
        $this->livre = $livre;

        return $this;
    }
}
