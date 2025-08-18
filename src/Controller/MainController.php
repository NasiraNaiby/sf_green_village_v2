<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategoriesRepository;
use App\Repository\ProduitsRepository;

final class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(
        CategoriesRepository $categories,
        ProduitsRepository $produit
            ): Response
    {
        $cat = $categories->findAll(); 
        $produits = $produit->findAll();
        return $this->render('accueil.html.twig', [
            'categories' => $cat,
            'produit' =>$produits
        ]);
    }


    #[Route('/categories/{id}', name: 'main_categories')]
    public function categorie(CategoriesRepository $categories, ProduitsRepository $produit, int $id): Response
    {
        $cat = $categories->find($id); 
        $produits = $produit->findAll();
        return $this->render('categories.html.twig', ['cat' => $cat, 'produits' => $produits]);
    }

    #[Route('/fournisseurs', name: 'main_fourni')]
    public function fournisseurs(): Response
    {
        return $this->render('fournisseurs.html.twig');
    }

    #[Route('/produit', name: 'main_produit')]
    public function produit(): Response
    {
        return $this->render('produit.html.twig');
    }
}
