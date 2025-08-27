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

    #[ORM\OneToOne(inversedBy: 'facture', targetEntity: Commandes::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commandes $commande = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateFacture = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $montantTotal = null;

   #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    private ?string $statutPaiement = null;


    public function getId(): ?int { return $this->id; }

    public function getCommande(): ?Commandes { return $this->commande; }
    public function setCommande(?Commandes $commande): static { $this->commande = $commande; return $this; }

    public function getDateFacture(): ?\DateTime { return $this->dateFacture; }
    public function setDateFacture(\DateTime $dateFacture): static { $this->dateFacture = $dateFacture; return $this; }

    public function getMontantTotal(): ?string { return $this->montantTotal; }
    public function setMontantTotal(?string $montantTotal): static { $this->montantTotal = $montantTotal; return $this; }

    public function getStatutPaiement(): ?string { return $this->statutPaiement; }
    public function setStatutPaiement(?string $statutPaiement): static { $this->statutPaiement = $statutPaiement; return $this; }
}
