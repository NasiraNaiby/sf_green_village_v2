<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use App\Entity\Produits;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'user')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    private ?string $password = null;

    #[ORM\OneToOne(mappedBy: 'user', targetEntity: Clients::class, cascade: ['persist', 'remove'])]
    private ?Clients $client = null;

    #[ORM\Column(length: 255)]
    private ?string $user_name = null;

    #[ORM\ManyToMany(targetEntity: Produits::class)]
    #[ORM\JoinTable(name: 'user_wishlist')]
    private Collection $wishlist;

    public function __construct()
    {
        $this->wishlist = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): static { $this->email = $email; return $this; }

    public function getUserIdentifier(): string { return (string) $this->email; }

    public function getRoles(): array { $roles = $this->roles; $roles[] = 'ROLE_USER'; return array_unique($roles); }
    public function setRoles(array $roles): static { $this->roles = $roles; return $this; }

    public function getPassword(): ?string { return $this->password; }
    public function setPassword(string $password): static { $this->password = $password; return $this; }

    #[\Deprecated]
    public function eraseCredentials(): void {}

    public function getClient(): ?Clients { return $this->client; }
    public function setClient(Clients $client): static { $this->client = $client; return $this; }

    public function getUserName(): ?string { return $this->user_name; }
    public function setUserName(string $user_name): static { $this->user_name = $user_name; return $this; }

    /** Wishlist methods */
    public function getWishlist(): Collection { return $this->wishlist; }

    public function addWishlist(Produits $produit): static
    {
        if (!$this->wishlist->contains($produit)) { $this->wishlist->add($produit); }
        return $this;
    }

    public function removeWishlist(Produits $produit): static
    {
        $this->wishlist->removeElement($produit);
        return $this;
    }
}
