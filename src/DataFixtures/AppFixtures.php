<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Produits;
use App\Entity\Categories;
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

        $user = new User();
        $user->setEmail('nasira@gmail.com');
        $password =  $this->hasher->hashPassword($user,"1234");
        $user->setPassword($password);
        
        $manager->persist($user);

        // Create and persist categories
        for ($i = 0; $i < 8; $i++) {
            $categorie = new Categories();
            $categorie->setNomCat($faker->word());
            $categorie->setDescCat($faker->sentence());
            $manager->persist($categorie);
            $categories[] = $categorie;
        }

        $manager->flush(); // 🔑 This ensures categories get assigned IDs before linking

        // Create and persist products
        for ($i = 0; $i < 25; $i++) {
            $produit = new Produits();
            $produit->setNomProduit($faker->word());
            $produit->setDescProduit($faker->sentence());
            $produit->setAchatPrix($faker->randomFloat(2, 10, 100));
            $produit->setVentPrix($faker->randomFloat(2, 10, 100));
            $produit->setPhoto('https://picsum.photos/200/300');

            // Randomly assign category
            $randomCategory = $categories[array_rand($categories)];
            $produit->setCategorie($randomCategory);

            $manager->persist($produit);
        }

        $manager->flush();
    }
}
