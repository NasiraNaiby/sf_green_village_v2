<?php

namespace App\Entity;

use App\Repository\ClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientsRepository::class)]
#[ORM\Table(name: 'clients')]
class Clients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    // #[ORM\Column(type: 'string', length: 255)]
    // private ?string $nom_client = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $type_client = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $condition_paiment = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $address_facturation = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $address_livrasion = null;

    #[ORM\OneToOne(inversedBy: 'client', targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(targetEntity: Vendeurs::class, mappedBy: 'id_clients')]
    private Collection $id_vend;

    #[ORM\OneToMany(targetEntity: Commandes::class, mappedBy: 'id_clients')]
    private Collection $commandes;

    #[ORM\Column(length: 10)]
    private ?string $client_cp = null;

    #[ORM\Column(length: 255)]
    private ?string $livrasion_cp = null;

    public function __construct()
    {
        $this->id_vend = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getNomClient(): ?string
    // {
    //     return $this->nom_client;
    // }

    // public function setNomClient(string $nom_client): static
    // {
    //     $this->nom_client = $nom_client;
    //     return $this;
    // }

    public function getTypeClient(): ?string
    {
        return $this->type_client;
    }

    public function setTypeClient(?string $type_client): static
    {
        $this->type_client = $type_client;
        return $this;
    }

    public function getConditionPaiment(): ?string
    {
        return $this->condition_paiment;
    }

    public function setConditionPaiment(?string $condition_paiment): static
    {
        $this->condition_paiment = $condition_paiment;
        return $this;
    }

    public function getAddressFacturation(): ?string
    {
        return $this->address_facturation;
    }

    public function setAddressFacturation(?string $address_facturation): static
    {
        $this->address_facturation = $address_facturation;
        return $this;
    }

    public function getAddressLivrasion(): ?string
    {
        return $this->address_livrasion;
    }

    public function setAddressLivrasion(string $address_livrasion): static
    {
        $this->address_livrasion = $address_livrasion;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;
        return $this;
    }

    public function getIdVend(): Collection
    {
        return $this->id_vend;
    }

    public function addIdVend(Vendeurs $idVend): static
    {
        if (!$this->id_vend->contains($idVend)) {
            $this->id_vend->add($idVend);
            $idVend->setIdClients($this);
        }

        return $this;
    }

    public function removeIdVend(Vendeurs $idVend): static
    {
        if ($this->id_vend->removeElement($idVend)) {
            if ($idVend->getIdClients() === $this) {
                $idVend->setIdClients(null);
            }
        }

        return $this;
    }

    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commandes $commande): static
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setIdClients($this);
        }

        return $this;
    }

    public function removeCommande(Commandes $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
            if ($commande->getIdClients() === $this) {
                $commande->setIdClients(null);
            }
        }

        return $this;
    }

    public function getClientCp(): ?string
    {
        return $this->client_cp;
    }

    public function setClientCp(string $client_cp): static
    {
        $this->client_cp = $client_cp;

        return $this;
    }

    public function getLivrasionCp(): ?string
    {
        return $this->livrasion_cp;
    }

    public function setLivrasionCp(string $livrasion_cp): static
    {
        $this->livrasion_cp = $livrasion_cp;

        return $this;
    }
}
