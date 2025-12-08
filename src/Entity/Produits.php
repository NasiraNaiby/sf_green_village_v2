<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Categories;
use App\Entity\User;
use App\Entity\Fournisseurs;
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

    #[ORM\Column(type: 'integer')]
    private ?int $stock = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\ManyToOne(targetEntity: Categories::class, inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categories $categorie = null;

    #[ORM\ManyToOne(targetEntity: Fournisseurs::class, inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fournisseurs $fournisseur = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'wishlist')]
    private Collection $users;

    #[ORM\OneToMany(targetEntity: ProduitImage::class, mappedBy: 'produit', cascade: ['persist', 'remove'])]
    private Collection $produitImages;

    /**
     * @var Collection<int, CommandeProduit>
     */
    #[ORM\OneToMany(targetEntity: CommandeProduit::class, mappedBy: 'produit')]
    private Collection $CommandeProduits;


    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->produitImages = new ArrayCollection();
        $this->CommandeProduits = new ArrayCollection();
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

    public function getFournisseur(): ?Fournisseurs
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseurs $fournisseur): static
    {
        $this->fournisseur = $fournisseur;
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
            $user->addWishlist($this);
        }
        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeWishlist($this);
        }
        return $this;
    }

    /**
     * @return Collection<int, ProduitImage>
     */
    public function getProduitImages(): Collection
    {
        return $this->produitImages;
    }

    public function addProduitImage(ProduitImage $produitImage): static
    {
        if (!$this->produitImages->contains($produitImage)) {
            $this->produitImages->add($produitImage);
            $produitImage->setProduit($this);
        }

        return $this;
    }

    public function removeProduitImage(ProduitImage $produitImage): static
    {
        if ($this->produitImages->removeElement($produitImage)) {
            if ($produitImage->getProduit() === $this) {
                $produitImage->setProduit(null);
            }
        }

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;
        return $this;
    }

    /**
     * @return Collection<int, CommandeProduit>
     */
    public function getCommandeProduits(): Collection
    {
        return $this->CommandeProduits;
    }

    public function addCommandeProduit(CommandeProduit $CommandeProduit): static
    {
        if (!$this->CommandeProduits->contains($CommandeProduit)) {
            $this->CommandeProduits->add($CommandeProduit);
            $CommandeProduit->setProduit($this);
        }

        return $this;
    }

    public function removeCommandeProduit(CommandeProduit $CommandeProduit): static
    {
        if ($this->CommandeProduits->removeElement($CommandeProduit)) {
            // set the owning side to null (unless already changed)
            if ($CommandeProduit->getProduit() === $this) {
                $CommandeProduit->setProduit(null);
            }
        }

        return $this;
    }

}
