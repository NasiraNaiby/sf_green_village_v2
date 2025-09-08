<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Produits;
use App\Entity\Categories;
use App\Entity\Fournisseurs;
use App\Entity\User;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher) {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $categories = [];

        // --- Suppliers ---
        $supplier1 = new Fournisseurs();
        $supplier1->setNomFournisseur('Yamaha');
        $supplier1->setEmailFou('yamaha@example.com');
        $supplier1->setPhoneFou(123456789);
        $supplier1->setFouDescription("Yamaha est reconnu pour ses pianos et instruments de musique de haute qualité.");
        $manager->persist($supplier1);

        $supplier2 = new Fournisseurs();
        $supplier2->setNomFournisseur('Fender');
        $supplier2->setEmailFou('fender@example.com');
        $supplier2->setPhoneFou(987654321);
        $supplier2->setFouDescription("Fender fabrique des guitares et basses électriques légendaires.");
        $manager->persist($supplier2);

        $suppliers = [$supplier1, $supplier2];

        // --- User ---
        $user = new User();
        $user->setEmail('nasiraabcd@gmail.com');
        $user->setUserName('Hannah');
        $user->setPassword($this->hasher->hashPassword($user, "1234"));
        $manager->persist($user);

        // --- Categories ---
        $categoryNames = ['Cordes', 'Percussions', 'Vents', 'Claviers'];
        foreach ($categoryNames as $name) {
            $categorie = new Categories();
            $categorie->setNomCat($name);
            $categorie->setDescCat($faker->sentence());
            $manager->persist($categorie);
            $categories[] = $categorie;
        }

        $manager->flush();

        // --- Product images ---
        $productImages = [
            'images/greenguit.jpg',
            'images/guit.webp',
            'images/guitar1.jpg',
            'images/guitar2.jpg',
        ];

        // --- Products ---
        for ($i = 0; $i < 25; $i++) {
            $produit = new Produits();
            $produit->setNomProduit($faker->word());
            $produit->setDescProduit($faker->sentence());
            $produit->setVentPrix($faker->randomFloat(2, 50, 500));

            // Pick random category
            $produit->setCategorie($categories[array_rand($categories)]);

            // Pick random supplier
            $produit->setFournisseur($suppliers[array_rand($suppliers)]);

            // Pick random local image
            $produit->setPhoto($productImages[array_rand($productImages)]);

            $manager->persist($produit);
        }

        $manager->flush();
    }
}
