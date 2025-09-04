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

        $supplier = new Fournisseurs();
        $supplier->setNomFournisseur('Default Supplier');
        $supplier->setEmailFou('default@example.com');
        $supplier->setPhoneFou(123456789);
        $supplier->setProduitExclusif("guitar");
        $supplier->setFouDescription("    Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
        Debitis excepturi, alias deleniti ad quasi perferendis repudiandae facilis blanditiis sapiente 
        ratione sint libero tempora tenetur, asperiores quo porro voluptatum magni illum.");
        $manager->persist($supplier);
        $this->addReference('default_supplier', $supplier);

        $user = new User();
        $user->setEmail('nasiraabcd@gmail.com');
        $user->setUserName('Hannah');
        $password = $this->hasher->hashPassword($user, "1234");
        $user->setPassword($password);
        $manager->persist($user);

        for ($i = 0; $i < 8; $i++) {
            $categorie = new Categories();
            $categorie->setNomCat($faker->word());
            $categorie->setDescCat($faker->sentence());
            $manager->persist($categorie);
            $categories[] = $categorie;
        }

        $manager->flush(); 
        for ($i = 0; $i < 25; $i++) {
            $produit = new Produits();
            $produit->setNomProduit($faker->word());
            $produit->setDescProduit($faker->sentence());
            $produit->setVentPrix($faker->randomFloat(2, 10, 100));
            $produit->setPhoto('https://picsum.photos/200/300');

            $produit->setCategorie($categories[array_rand($categories)]);
            $produit->setFournisseur($supplier); 
            $manager->persist($produit);
        }

        $manager->flush();
    }
}
