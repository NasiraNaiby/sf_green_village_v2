<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategoriesRepository;
use App\Repository\ProduitsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Produits;
use App\Service\Panier;


final class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(CategoriesRepository $categories, ProduitsRepository $produit): Response
    {
        $limitedCategories = $categories->findBy([], null, 4); 
        $produits = $produit->findAll();

        return $this->render('accueil.html.twig', [
            'categories' => $limitedCategories,
                'produit' =>$produits
        ]);
    }


    #[Route('/categories', name: 'main_categories')]
    public function categorie(CategoriesRepository $categories): Response
    {
        $cat = $categories->findAll(); 
        return $this->render('categories.html.twig', ['categories' => $cat]);
    }


    #[Route('/categories/{id}', name: 'produit_par_categories')]
    public function produit_categorie(CategoriesRepository $categories, ProduitsRepository $produit, int $id): Response
    {
        $cat = $categories->find($id); 
        $produits = $produit->findAll();
        return $this->render('produit_cate.html.twig', ['cat' => $cat, 'produits' => $produits]);
    }

    #[Route('/panier', name: 'main_panier')]
    public function panier(Panier $panier, ProduitsRepository $repo): Response
    {
        $panier_complet = [];
        $total = 0;
        foreach ($panier->liste() as $id => $quantite) {
            $produit = $repo->find($id);
            $panier_complet[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];
            $total += $produit->getVentPrix() * $quantite;
        }
       // dd($panier);
        return $this->render('panier.html.twig', [
            'panier'=> $panier_complet,
            'totalPrice' => $total
        ]);
    }
    #[Route('/panier/add/{id}', name: 'main_add_panier')]
    public function add( Produits $produit, Panier $panier ): Response
    {

        $panier->add($produit->getId());
        return $this->redirectToRoute('main_panier');
    }

    #[Route('/panier/del/{id}', name: 'main_del_panier')]
    public function delete(Produits $produit, Panier $panier): Response
    {
        $panier->delete($produit->getId());
        return $this->redirectToRoute('main_panier');
    }

    #[Route('/fournisseurs', name: 'main_fourni')]
    public function fournisseurs(): Response
    {
        return $this->render('fournisseurs.html.twig');
    }

    #[Route('/produit', name: 'main_produit')]
    public function produit(ProduitsRepository $produit): Response
    {
        $produits = $produit->findAll();  
        return $this->render('produit.html.twig',['produits' => $produits]);
    }
}
