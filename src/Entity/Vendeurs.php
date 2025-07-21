<?php

namespace App\Entity;

use App\Repository\VendeursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VendeursRepository::class)]
class Vendeurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_vendeur = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_vend = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email_vend = null;

    #[ORM\Column(nullable: true)]
    private ?int $phone_vend = null;

    #[ORM\Column(nullable: true)]
    private ?int $id_client = null;

    #[ORM\ManyToOne(inversedBy: 'id_vend')]
    private ?Clients $id_clients = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdVendeur(): ?int
    {
        return $this->id_vendeur;
    }

    public function setIdVendeur(int $id_vendeur): static
    {
        $this->id_vendeur = $id_vendeur;

        return $this;
    }

    public function getNomVend(): ?string
    {
        return $this->nom_vend;
    }

    public function setNomVend(string $nom_vend): static
    {
        $this->nom_vend = $nom_vend;

        return $this;
    }

    public function getEmailVend(): ?string
    {
        return $this->email_vend;
    }

    public function setEmailVend(?string $email_vend): static
    {
        $this->email_vend = $email_vend;

        return $this;
    }

    public function getPhoneVend(): ?int
    {
        return $this->phone_vend;
    }

    public function setPhoneVend(?int $phone_vend): static
    {
        $this->phone_vend = $phone_vend;

        return $this;
    }

    public function getIdClient(): ?int
    {
        return $this->id_client;
    }

    public function setIdClient(?int $id_client): static
    {
        $this->id_client = $id_client;

        return $this;
    }

    public function getIdClients(): ?Clients
    {
        return $this->id_clients;
    }

    public function setIdClients(?Clients $id_clients): static
    {
        $this->id_clients = $id_clients;

        return $this;
    }
}
