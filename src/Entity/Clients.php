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

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $typeClient = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $conditionPaiement = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $adresseFacturation = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $adresseLivraison = null;

    #[ORM\Column(length: 10)]
    private ?string $codePostalFacturation = null;

    #[ORM\Column(length: 255)]
    private ?string $codePostalLivraison = null;

    #[ORM\OneToOne(inversedBy: 'client', targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(targetEntity: Vendeurs::class, mappedBy: 'client')]
    private Collection $vendeurs;

    #[ORM\OneToMany(targetEntity: Commandes::class, mappedBy: 'client')]
    private Collection $commandes;

    public function __construct()
    {
        $this->vendeurs = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getTypeClient(): ?string { return $this->typeClient; }
    public function setTypeClient(?string $typeClient): static { $this->typeClient = $typeClient; return $this; }

    public function getConditionPaiement(): ?string { return $this->conditionPaiement; }
    public function setConditionPaiement(?string $conditionPaiement): static { $this->conditionPaiement = $conditionPaiement; return $this; }

    public function getAdresseFacturation(): ?string { return $this->adresseFacturation; }
    public function setAdresseFacturation(?string $adresseFacturation): static { $this->adresseFacturation = $adresseFacturation; return $this; }

    public function getAdresseLivraison(): ?string { return $this->adresseLivraison; }
    public function setAdresseLivraison(string $adresseLivraison): static { $this->adresseLivraison = $adresseLivraison; return $this; }

    public function getCodePostalFacturation(): ?string { return $this->codePostalFacturation; }
    public function setCodePostalFacturation(string $codePostalFacturation): static { $this->codePostalFacturation = $codePostalFacturation; return $this; }

    public function getCodePostalLivraison(): ?string { return $this->codePostalLivraison; }
    public function setCodePostalLivraison(string $codePostalLivraison): static { $this->codePostalLivraison = $codePostalLivraison; return $this; }

    public function getUser(): ?User { return $this->user; }
    public function setUser(User $user): static { $this->user = $user; return $this; }

    public function getVendeurs(): Collection { return $this->vendeurs; }
    public function addVendeur(Vendeurs $vendeur): static {
        if (!$this->vendeurs->contains($vendeur)) {
            $this->vendeurs->add($vendeur);
            $vendeur->setClient($this);
        }
        return $this;
    }
    public function removeVendeur(Vendeurs $vendeur): static {
        if ($this->vendeurs->removeElement($vendeur)) {
            if ($vendeur->getClient() === $this) {
                $vendeur->setClient(null);
            }
        }
        return $this;
    }

    public function getCommandes(): Collection { return $this->commandes; }
    public function addCommande(Commandes $commande): static {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setClient($this);
        }
        return $this;
    }
    public function removeCommande(Commandes $commande): static {
        if ($this->commandes->removeElement($commande)) {
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }
        return $this;
    }
}
