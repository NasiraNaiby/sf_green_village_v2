<?php

namespace App\Entity;

use App\Repository\FacturesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FacturesRepository::class)]
class Factures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_facture = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Commandes $id_commande = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_facture = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $montant_total = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $paiment_statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFacture(): ?int
    {
        return $this->id_facture;
    }

    public function setIdFacture(int $id_facture): static
    {
        $this->id_facture = $id_facture;

        return $this;
    }

    public function getIdCommande(): ?Commandes
    {
        return $this->id_commande;
    }

    public function setIdCommande(?Commandes $id_commande): static
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    public function getDateFacture(): ?\DateTime
    {
        return $this->date_facture;
    }

    public function setDateFacture(\DateTime $date_facture): static
    {
        $this->date_facture = $date_facture;

        return $this;
    }

    public function getMontantTotal(): ?string
    {
        return $this->montant_total;
    }

    public function setMontantTotal(?string $montant_total): static
    {
        $this->montant_total = $montant_total;

        return $this;
    }

    public function getPaimentStatut(): ?string
    {
        return $this->paiment_statut;
    }

    public function setPaimentStatut(?string $paiment_statut): static
    {
        $this->paiment_statut = $paiment_statut;

        return $this;
    }
}
