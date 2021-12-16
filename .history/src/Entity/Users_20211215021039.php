<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UsersRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users implements UserInterface
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $civilite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $codePostale;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrePoint;

    /**
     * @ORM\OneToMany(targetEntity=Posseder::class, mappedBy="users")
     */
    private $posseders;

    /**
     * @ORM\OneToMany(targetEntity=Commander::class, mappedBy="userCommander")
     */
    private $commanders;

    public function __construct()
    {
        $this->posseders = new ArrayCollection();
        $this->commanders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostale(): ?string
    {
        return $this->codePostale;
    }

    public function setCodePostale(string $codePostale): self
    {
        $this->codePostale = $codePostale;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getNbrePoint(): ?int
    {
        return $this->nbrePoint;
    }

    public function setNbrePoint(int $nbrePoint): self
    {
        $this->nbrePoint = $nbrePoint;

        return $this;
    }

    public function getUserIdentifier()
    {
        return $this->email;
    }
    public function getUsername()
    {
        return $this->email;
    }
    public function getRoles()
    {
        return ['ROLE_USER'];
    }
    public function getSalt()
    {
        
    }
    public function eraseCredentials()
    {
        
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
            $posseder->setUsers($this);
        }

        return $this;
    }

    public function removePosseder(Posseder $posseder): self
    {
        if ($this->posseders->removeElement($posseder)) {
            // set the owning side to null (unless already changed)
            if ($posseder->getUsers() === $this) {
                $posseder->setUsers(null);
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
            $commander->setUserCommander($this);
        }

        return $this;
    }

    public function removeCommander(Commander $commander): self
    {
        if ($this->commanders->removeElement($commander)) {
            // set the owning side to null (unless already changed)
            if ($commander->getUserCommander() === $this) {
                $commander->setUserCommander(null);
            }
        }

        return $this;
    }
}
