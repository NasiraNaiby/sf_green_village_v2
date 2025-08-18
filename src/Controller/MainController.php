<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategoriesRepository;

final class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(CategoriesRepository $categories): Response
    {
        $cat = $categories->findAll(); 
        return $this->render('accueil.html.twig', ['categories', $categories]);
    }

    #[Route('/categories', name: 'main_categories')]
    public function categorie(): Response
    {
        return $this->render('categories.html.twig');
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
