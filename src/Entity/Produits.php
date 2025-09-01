<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Categories;
use App\Entity\User;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
#[ApiResource]
class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_produit = null;

    #[ORM\Column(length: 255)]
    private ?string $desc_produit = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $vent_prix = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\ManyToOne(targetEntity: Categories::class, inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categories $categorie = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'wishlist')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->nom_produit;
    }

    public function setNomProduit(string $nom_produit): static
    {
        $this->nom_produit = $nom_produit;
        return $this;
    }

    public function getDescProduit(): ?string
    {
        return $this->desc_produit;
    }

    public function setDescProduit(string $desc_produit): static
    {
        $this->desc_produit = $desc_produit;
        return $this;
    }

    public function getVentPrix(): ?string
    {
        return $this->vent_prix;
    }

    public function setVentPrix(string $vent_prix): static
    {
        $this->vent_prix = $vent_prix;
        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;
        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): static
    {
        $this->categorie = $categorie;
        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addWishlist($this); // keep the relationship in sync
        }
        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeWishlist($this); // keep the relationship in sync
        }
        return $this;
    }
}
