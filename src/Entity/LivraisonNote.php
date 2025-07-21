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

    #[ORM\Column]
    private ?int $id_liv_note = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Commandes $id_commande = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statut_liv = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $date_liv = null;

    #[ORM\Column(length: 255)]
    private ?string $note_liv = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdLivNote(): ?int
    {
        return $this->id_liv_note;
    }

    public function setIdLivNote(int $id_liv_note): static
    {
        $this->id_liv_note = $id_liv_note;

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

    public function getStatutLiv(): ?string
    {
        return $this->statut_liv;
    }

    public function setStatutLiv(?string $statut_liv): static
    {
        $this->statut_liv = $statut_liv;

        return $this;
    }

    public function getDateLiv(): ?\DateTime
    {
        return $this->date_liv;
    }

    public function setDateLiv(?\DateTime $date_liv): static
    {
        $this->date_liv = $date_liv;

        return $this;
    }

    public function getNoteLiv(): ?string
    {
        return $this->note_liv;
    }

    public function setNoteLiv(string $note_liv): static
    {
        $this->note_liv = $note_liv;

        return $this;
    }
}
