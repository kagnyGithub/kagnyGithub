<?php

namespace App\Entity;

use App\Repository\CommanderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommanderRepository::class)
 */
class Commander
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="commanders")
     */
    private $userCommander;

    /**
     * @ORM\ManyToOne(targetEntity=Livres::class, inversedBy="commanders")
     */
    private $livreCmmande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserCommander(): ?Users
    {
        return $this->userCommander;
    }

    public function setUserCommander(?Users $userCommander): self
    {
        $this->userCommander = $userCommander;

        return $this;
    }

    public function getLivreCmmande(): ?Livres
    {
        return $this->livreCmmande;
    }

    public function setLivreCmmande(?Livres $livreCmmande): self
    {
        $this->livreCmmande = $livreCmmande;

        return $this;
    }
}
