<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Produits;
use ApiPlatform\Metadata\ApiResource;


#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
#[ApiResource]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_cat = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $desc_cat = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Produits::class)]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCat(): ?string
    {
        return $this->nom_cat;
    }

    public function setNomCat(string $nom_cat): static
    {
        $this->nom_cat = $nom_cat;
        return $this;
    }

    public function getDescCat(): ?string
    {
        return $this->desc_cat;
    }

    public function setDescCat(?string $desc_cat): static
    {
        $this->desc_cat = $desc_cat;
        return $this;
    }

    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produits $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setCategorie($this);
        }
        return $this;
    }

    public function removeProduit(Produits $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            if ($produit->getCategorie() === $this) {
                $produit->setCategorie(null);
            }
        }
        return $this;
    }
}
