<?php

namespace App\Entity;

use App\Repository\LivresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivresRepository::class)
 */
class Livres
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
    private $nomLivre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $editeur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $parution;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $codeBare;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $format;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrePage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disponible;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrePoint;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="livres")
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Posseder::class, mappedBy="livre")
     */
    private $posseders;

    /**
     * @ORM\OneToMany(targetEntity=Commander::class, mappedBy="livreCmmande")
     */
    private $commanders;

    /**
     * @ORM\Column(type="text")
     */
    private $resumer;

    public function __construct()
    {
        $this->posseders = new ArrayCollection();
        $this->commanders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLivre(): ?string
    {
        return $this->nomLivre;
    }

    public function setNomLivre(string $nomLivre): self
    {
        $this->nomLivre = $nomLivre;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getEditeur(): ?string
    {
        return $this->editeur;
    }

    public function setEditeur(string $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }

    public function getParution(): ?string
    {
        return $this->parution;
    }

    public function setParution(string $parution): self
    {
        $this->parution = $parution;

        return $this;
    }

    public function getCodeBare(): ?string
    {
        return $this->codeBare;
    }

    public function setCodeBare(string $codeBare): self
    {
        $this->codeBare = $codeBare;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getNbrePage(): ?int
    {
        return $this->nbrePage;
    }

    public function setNbrePage(int $nbrePage): self
    {
        $this->nbrePage = $nbrePage;

        return $this;
    }

    public function getDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function getNbrePoint(): ?int
    {
        return $this->nbrePoint;
    }

    public function setNbrePoint(?int $nbrePoint): self
    {
        $this->nbrePoint = $nbrePoint;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Posseder[]
     */
    public function getPosseders(): Collection
    {
        return $this->posseders;
    }

    public function addPosseder(Posseder $posseder): self
    {
        if (!$this->posseders->contains($posseder)) {
            $this->posseders[] = $posseder;
            $posseder->setLivre($this);
        }

        return $this;
    }

    public function removePosseder(Posseder $posseder): self
    {
        if ($this->posseders->removeElement($posseder)) {
            // set the owning side to null (unless already changed)
            if ($posseder->getLivre() === $this) {
                $posseder->setLivre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commander[]
     */
    public function getCommanders(): Collection
    {
        return $this->commanders;
    }

    public function addCommander(Commander $commander): self
    {
        if (!$this->commanders->contains($commander)) {
            $this->commanders[] = $commander;
            $commander->setLivreCmmande($this);
        }

        return $this;
    }

    public function removeCommander(Commander $commander): self
    {
        if ($this->commanders->removeElement($commander)) {
            // set the owning side to null (unless already changed)
            if ($commander->getLivreCmmande() === $this) {
                $commander->setLivreCmmande(null);
            }
        }

        return $this;
    }

    public function getResumer(): ?string
    {
        return $this->resumer;
    }

    public function setResumer(string $resumer): self
    {
        $this->resumer = $resumer;

        return $this;
    }
}
