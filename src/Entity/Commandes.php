<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Clients::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Clients $client = null;

    #[ORM\ManyToMany(targetEntity: Produits::class)]
    private Collection $produits;

    #[ORM\Column(nullable: true)]
    private ?int $quantite = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $prixUnitaire = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $prixTotal = null;

    #[ORM\OneToOne(mappedBy: 'commande', cascade: ['persist', 'remove'])]
    private ?LivraisonNote $livraisonNote = null;

    #[ORM\OneToOne(mappedBy: 'commande', cascade: ['persist', 'remove'])]
    private ?Factures $facture = null;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getClient(): ?Clients { return $this->client; }
    public function setClient(?Clients $client): static { $this->client = $client; return $this; }

    public function getProduits(): Collection { return $this->produits; }
    public function addProduit(Produits $produit): static {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
        }
        return $this;
    }
    public function removeProduit(Produits $produit): static {
        $this->produits->removeElement($produit);
        return $this;
    }

    public function getQuantite(): ?int { return $this->quantite; }
    public function setQuantite(?int $quantite): static { $this->quantite = $quantite; return $this; }

    public function getPrixUnitaire(): ?string { return $this->prixUnitaire; }
    public function setPrixUnitaire(?string $prixUnitaire): static { $this->prixUnitaire = $prixUnitaire; return $this; }

    public function getPrixTotal(): ?string { return $this->prixTotal; }
    public function setPrixTotal(?string $prixTotal): static { $this->prixTotal = $prixTotal; return $this; }

    public function getLivraisonNote(): ?LivraisonNote { return $this->livraisonNote; }
    public function setLivraisonNote(?LivraisonNote $livraisonNote): static { $this->livraisonNote = $livraisonNote; return $this; }

    public function getFacture(): ?Factures { return $this->facture; }
    public function setFacture(?Factures $facture): static { $this->facture = $facture; return $this; }
}
