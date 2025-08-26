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
use App\Form\CheckoutType;
use App\Entity\Commandes;
use Symfony\Component\Security\Core\Security;
use App\Repository\ClientsRepository;
use Doctrine\ORM\EntityManagerInterface;



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

    // #[Route('/panier', name: 'main_panier')]
    // public function panier(Panier $panier, ProduitsRepository $repo): Response
    // {
        
    //     $panier_complet = [];
    //     $total = 0;
    //     foreach ($panier->liste() as $id => $quantite) {
    //         $produit = $repo->find($id);
    //         $panier_complet[] = [
    //             'produit' => $produit,
    //             'quantite' => $quantite
    //         ];
    //         $total += $produit->getVentPrix() * $quantite;
    //     }
    //    // dd($panier);
    //     return $this->render('panier.html.twig', [
    //         'panier'=> $panier_complet,
    //         'totalPrice' => $total
    //     ]);
    // }

#[Route('/panier', name: 'main_panier')]
public function panier(
    Request $request,
    Panier $panier,
    ProduitsRepository $repo,
    ClientsRepository $clientsRepository,
    Security $security,
    EntityManagerInterface $entityManager
): Response {

    $user = $security->getUser();

    if (!$user) {
        return $this->redirectToRoute('app_login');
    }

    $client = $clientsRepository->findOneBy(['user' => $user]);

    if (!$client) {
        return $this->redirectToRoute('app_register');
    }

    $panier_complet = [];
    $total = 0;
    $quantite_totale = 0;
    $produits = [];

    foreach ($panier->liste() as $id => $quantite) {
        $produit = $repo->find($id);
        if ($produit) {
            $panier_complet[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];
            $total += $produit->getVentPrix() * $quantite;
            $quantite_totale += $quantite;
            $produits[] = $produit;
        }
    }

    $commande = new Commandes();
    $commande->setClient($client);
    $commande->setPrixTotal($total);
    $commande->setQuantite($quantite_totale);
    foreach ($produits as $p) {
        $commande->addProduit($p);
    }

    $form = $this->createForm(CheckoutType::class, $commande, [
        'client_data' => [
            'email' => $client->getClientEmail(),
            'phone' => $client->getClientPhone(),
            'adresse' => $client->getAdresseLivraison(),
            'postal' => $client->getCodePostalLivraison(),
        ]
    ]);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        if (!$client->getClientEmail()) {
            $client->setClientEmail($form->get('client_email')->getData());
        }
        if (!$client->getClientPhone()) {
            $client->setClientPhone($form->get('client_phone')->getData());
        }
        if (!$client->getAdresseLivraison()) {
            $client->setAdresseLivraison($form->get('adresseLivraison')->getData());
        }
        if (!$client->getCodePostalLivraison()) {
            $client->setCodePostalLivraison($form->get('codePostalLivraison')->getData());
        }

        // $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($client);
        $entityManager->persist($commande);
        $entityManager->flush();

        return $this->redirectToRoute('main');
    }

    return $this->render('panier.html.twig', [
        'panier' => $panier_complet,
        'totalPrice' => $total,
        'form' => $form->createView()
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
    #[Route('/about', name: 'main_about')]
    public function about(): Response
    { 
        return $this->render('about.html.twig');
    }

    #[Route('/galerie', name: 'main_magasin')]
    public function galerie(ProduitsRepository $produit): Response
    { 
        $produits = $produit->findAll();
        return $this->render('galerie.html.twig', ['produits' => $produits]);
    }
     #[Route('/test', name: 'main_test')]
    public function test(): Response
    { 
        
        return $this->render('test.html.twig');
    }
}
