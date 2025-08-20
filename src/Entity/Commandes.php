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

    #[ORM\Column]
    private ?int $id_commande = null;

    #[ORM\ManyToOne(targetEntity: Clients::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: false)]
    private ?Clients $client = null;

    /**
     * @var Collection<int, Produits>
     */
    #[ORM\ManyToMany(targetEntity: Produits::class)]
    private Collection $id_produit;

    #[ORM\Column(nullable: true)]
    private ?int $quantité = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $unit_prix = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $total_prix = null;

    public function __construct()
    {
        $this->id_produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCommande(): ?int
    {
        return $this->id_commande;
    }

    public function setIdCommande(int $id_commande): static
    {
        $this->id_commande = $id_commande;
        return $this;
    }

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    public function setClient(?Clients $client): static
    {
        $this->client = $client;
        return $this;
    }

    public function getIdProduit(): Collection
    {
        return $this->id_produit;
    }

    public function addIdProduit(Produits $idProduit): static
    {
        if (!$this->id_produit->contains($idProduit)) {
            $this->id_produit->add($idProduit);
        }

        return $this;
    }

    public function removeIdProduit(Produits $idProduit): static
    {
        $this->id_produit->removeElement($idProduit);
        return $this;
    }

    public function getQuantité(): ?int
    {
        return $this->quantité;
    }

    public function setQuantité(?int $quantité): static
    {
        $this->quantité = $quantité;
        return $this;
    }

    public function getUnitPrix(): ?string
    {
        return $this->unit_prix;
    }

    public function setUnitPrix(?string $unit_prix): static
    {
        $this->unit_prix = $unit_prix;
        return $this;
    }

    public function getTotalPrix(): ?string
    {
        return $this->total_prix;
    }

    public function setTotalPrix(?string $total_prix): static
    {
        $this->total_prix = $total_prix;
        return $this;
    }
}
