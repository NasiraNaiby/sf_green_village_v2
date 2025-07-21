<?php

namespace App\Entity;

use App\Repository\ClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientsRepository::class)]
class Clients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_client = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_client = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $type_client = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $email_client = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $condition_paiment = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address_facturation = null;

    #[ORM\Column(length: 255)]
    private ?string $address_livrasion = null;

    /**
     * @var Collection<int, Vendeurs>
     */
    #[ORM\OneToMany(targetEntity: Vendeurs::class, mappedBy: 'id_clients')]
    private Collection $id_vend;

    /**
     * @var Collection<int, Commandes>
     */
    #[ORM\OneToMany(targetEntity: Commandes::class, mappedBy: 'id_clients')]
    private Collection $commandes;

    public function __construct()
    {
        $this->id_vend = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdClient(): ?int
    {
        return $this->id_client;
    }

    public function setIdClient(int $id_client): static
    {
        $this->id_client = $id_client;

        return $this;
    }

    public function getNomClient(): ?string
    {
        return $this->nom_client;
    }

    public function setNomClient(string $nom_client): static
    {
        $this->nom_client = $nom_client;

        return $this;
    }

    public function getTypeClient(): ?string
    {
        return $this->type_client;
    }

    public function setTypeClient(?string $type_client): static
    {
        $this->type_client = $type_client;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getEmailClient(): ?string
    {
        return $this->email_client;
    }

    public function setEmailClient(string $email_client): static
    {
        $this->email_client = $email_client;

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

    /**
     * @return Collection<int, Vendeurs>
     */
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
            // set the owning side to null (unless already changed)
            if ($idVend->getIdClients() === $this) {
                $idVend->setIdClients(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commandes>
     */
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
            // set the owning side to null (unless already changed)
            if ($commande->getIdClients() === $this) {
                $commande->setIdClients(null);
            }
        }

        return $this;
    }

    
}
