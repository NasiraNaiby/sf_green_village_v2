<?php

namespace App\Entity;

use App\Repository\LivraisonNoteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonNoteRepository::class)]
class LivraisonNote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'livraisonNote', targetEntity: Commandes::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commandes $commande = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statutLivraison = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateLivraison = null;

    #[ORM\Column(length: 255)]
    private ?string $noteLivraison = null;

    public function getId(): ?int { return $this->id; }

    public function getCommande(): ?Commandes { return $this->commande; }
    public function setCommande(?Commandes $commande): static { $this->commande = $commande; return $this; }

    public function getStatutLivraison(): ?string { return $this->statutLivraison; }
    public function setStatutLivraison(?string $statutLivraison): static { $this->statutLivraison = $statutLivraison; return $this; }

    public function getDateLivraison(): ?\DateTime { return $this->dateLivraison; }
    public function setDateLivraison(?\DateTime $dateLivraison): static { $this->dateLivraison = $dateLivraison; return $this; }

    public function getNoteLivraison(): ?string { return $this->noteLivraison; }
    public function setNoteLivraison(string $noteLivraison): static { $this->noteLivraison = $noteLivraison; return $this; }
}
