<?php

namespace App\Entity;

use App\Repository\FournisseursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseursRepository::class)]
class Fournisseurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'fou_description', type: 'text', nullable: true)]
    private ?string $fouDescription = null;


    #[ORM\Column(length: 255)]
    private ?string $nom_fournisseur = null;

    #[ORM\Column(length: 255)]
    private ?string $email_fou = null;

    #[ORM\Column]
    private ?int $phone_fou = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $produit_exclusif = null;

    public function getId(): ?int
    {
        return $this->id;
    }

   
    public function getNomFournisseur(): ?string
    {
        return $this->nom_fournisseur;
    }

    public function setNomFournisseur(string $nom_fournisseur): static
    {
        $this->nom_fournisseur = $nom_fournisseur;

        return $this;
    }

    public function getEmailFou(): ?string
    {
        return $this->email_fou;
    }

    public function setEmailFou(string $email_fou): static
    {
        $this->email_fou = $email_fou;

        return $this;
    }

    public function getPhoneFou(): ?int
    {
        return $this->phone_fou;
    }

    public function setPhoneFou(int $phone_fou): static
    {
        $this->phone_fou = $phone_fou;

        return $this;
    }

    public function getProduitExclusif(): ?string
    {
        return $this->produit_exclusif;
    }

    public function setProduitExclusif(?string $produit_exclusif): static
    {
        $this->produit_exclusif = $produit_exclusif;

        return $this;
    }

    public function getFouDescription(): ?string
    {
        return $this->fouDescription;
    }

    public function setFouDescription(?string $fouDescription): static
    {
        $this->fouDescription = $fouDescription;
        return $this;
    }
}
