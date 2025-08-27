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
use App\Entity\Factures;
use App\Service\MailerService; 
use Twig\Environment as TwigEnvironment; 



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
// 
// #[Route('/panier', name: 'main_panier')]
// public function panier(
//     Request $request,
//     Panier $panier,
//     ProduitsRepository $repo,
//     ClientsRepository $clientsRepository,
//     Security $security,
//     EntityManagerInterface $entityManager
// ): Response {

//     $user = $security->getUser();

//     if (!$user) {
//         return $this->redirectToRoute('app_login');
//     }

//     $client = $clientsRepository->findOneBy(['user' => $user]);

//     if (!$client) {
//         return $this->redirectToRoute('app_register');
//     }

//     $panier_complet = [];
//     $total = 0;
//     $quantite_totale = 0;
//     $produits = [];


//     foreach ($panier->liste() as $id => $quantite) {
//         $produit = $repo->find($id);
//         if ($produit) {
//             $panier_complet[] = [
//                 'produit' => $produit,
//                 'quantite' => $quantite
//             ];
//             $total += $produit->getVentPrix() * $quantite;
//             $quantite_totale += $quantite;
//             $produits[] = $produit;
//         }
//     }

//     $commande = new Commandes();
//     $commande->setClient($client);
//     $commande->setPrixTotal($total);
//     $commande->setQuantite($quantite_totale);
//     foreach ($produits as $p) {
//         $commande->addProduit($p);
//     }

//     $form = $this->createForm(CheckoutType::class, $commande, [
//         'client_data' => [
//             'email' => $client->getClientEmail(),
//             'phone' => $client->getClientPhone(),
//             'adresse' => $client->getAdresseLivraison(),
//             'postal' => $client->getCodePostalLivraison(),
//         ]
//     ]);

//     $form->handleRequest($request);

//     if ($form->isSubmitted() && $form->isValid()) {
//         if (!$client->getClientEmail()) {
//             $client->setClientEmail($form->get('client_email')->getData());
//         }
//         if (!$client->getClientPhone()) {
//             $client->setClientPhone($form->get('client_phone')->getData());
//         }
//         if (!$client->getAdresseLivraison()) {
//             $client->setAdresseLivraison($form->get('adresseLivraison')->getData());
//         }
//         if (!$client->getCodePostalLivraison()) {
//             $client->setCodePostalLivraison($form->get('codePostalLivraison')->getData());
//         }

//         // $entityManager = $this->getDoctrine()->getManager();
//         $entityManager->persist($client);
//         $entityManager->persist($commande);
//         $entityManager->flush();

//         $panier->clear();
//         $this->addFlash('success', 'Votre commande a été enregistrée avec succès.');
//         return $this->redirectToRoute('main_panier');
//     }

//     return $this->render('panier.html.twig', [
//         'panier' => $panier_complet,
//         'totalPrice' => $total,
//         'form' => $form->createView()
//     ]);
// }

// #[Route('/panier', name: 'main_panier')]
// public function panier(
//     Request $request,
//     Panier $panier,
//     ProduitsRepository $repo,
//     ClientsRepository $clientsRepository,
//     Security $security,
//     EntityManagerInterface $entityManager
// ): Response {

//     $user = $security->getUser();

//     if (!$user) {
//         return $this->redirectToRoute('app_login');
//     }

//     $client = $clientsRepository->findOneBy(['user' => $user]);

//     if (!$client) {
//         return $this->redirectToRoute('app_register');
//     }

//     $panier_complet = [];
//     $total = 0;
//     $quantite_totale = 0;
//     $produits = [];

//     foreach ($panier->liste() as $id => $quantite) {
//         $produit = $repo->find($id);
//         if ($produit) {
//             $panier_complet[] = [
//                 'produit' => $produit,
//                 'quantite' => $quantite
//             ];
//             $total += $produit->getVentPrix() * $quantite;
//             $quantite_totale += $quantite;
//             $produits[] = $produit;
//         }
//     }

    
//     if (count($produits) === 0) {
//         $this->addFlash('warning', 'Votre panier est vide.');
//         return $this->render('panier.html.twig', [
//             'panier' => $panier_complet,
//             'totalPrice' => $total,
//             'form' => null
//         ]);
//     }

//     $commande = new Commandes();
//     $commande->setClient($client);
//     $commande->setPrixTotal($total);
//     $commande->setQuantite($quantite_totale);
//     foreach ($produits as $p) {
//         $commande->addProduit($p);
//     }

//     $form = $this->createForm(CheckoutType::class, $commande, [
//         'client_data' => [
//             'email' => $client->getClientEmail(),
//             'phone' => $client->getClientPhone(),
//             'adresse' => $client->getAdresseLivraison(),
//             'postal' => $client->getCodePostalLivraison(),
//         ]
//     ]);

//     $form->handleRequest($request);

//     if ($form->isSubmitted() && $form->isValid()) {
//         // Save client info from unmapped fields
//         if (!$client->getClientEmail()) {
//             $client->setClientEmail($form->get('client_email')->getData());
//         }
//         if (!$client->getClientPhone()) {
//             $client->setClientPhone($form->get('client_phone')->getData());
//         }
//         if (!$client->getAdresseLivraison()) {
//             $client->setAdresseLivraison($form->get('adresseLivraison')->getData());
//         }
//         if (!$client->getCodePostalLivraison()) {
//             $client->setCodePostalLivraison($form->get('codePostalLivraison')->getData());
//         }

//         $entityManager->persist($client);
//         $entityManager->persist($commande);

//         // --- Create Facture ---
//         $facture = new Factures();
//         $facture->setCommande($commande); // link to the order
//         $facture->setClient($client); // optional if you have a client field
//         $facture->setPrixTotal($commande->getPrixTotal());
//         $facture->setDateEmission(new \DateTime()); // for example
//         $facture->setStatus('En attente'); // or 'Paid' depending on your logic

//         $entityManager->persist($facture);

//         $entityManager->flush();

//         $panier->clear();
//         $this->addFlash('success', 'Votre commande a été enregistrée avec succès.');
//         return $this->redirectToRoute('main_panier');
//     }

//     return $this->render('panier.html.twig', [
//         'panier' => $panier_complet,
//         'totalPrice' => $total,
//         'form' => $form->createView(),
//         'client' => $client
//     ]);
// }
//before email service 
// #[Route('/panier', name: 'main_panier')]
// public function panier(
//     Request $request,
//     Panier $panier,
//     ProduitsRepository $repo,
//     ClientsRepository $clientsRepository,
//     Security $security,
//     EntityManagerInterface $entityManager
// ): Response {

//     $user = $security->getUser();
//     if (!$user) {
//         return $this->redirectToRoute('app_login');
//     }

//     $client = $clientsRepository->findOneBy(['user' => $user]);
//     if (!$client) {
//         return $this->redirectToRoute('app_register');
//     }

//     $panier_complet = [];
//     $total = 0;
//     $quantite_totale = 0;
//     $produits = [];

//     foreach ($panier->liste() as $id => $quantite) {
//         $produit = $repo->find($id);
//         if ($produit) {
//             $panier_complet[] = [
//                 'produit' => $produit,
//                 'quantite' => $quantite
//             ];
//             $total += $produit->getVentPrix() * $quantite;
//             $quantite_totale += $quantite;
//             $produits[] = $produit;
//         }
//     }

//     if (count($produits) === 0) {
//         $this->addFlash('warning', 'Votre panier est vide.');
//         return $this->render('panier.html.twig', [
//             'panier' => $panier_complet,
//             'totalPrice' => $total,
//             'form' => null,
//             'client' => $client
//         ]);
//     }

//     $commande = new Commandes();
//     $commande->setClient($client);
//     $commande->setPrixTotal($total);
//     $commande->setQuantite($quantite_totale);
//     foreach ($produits as $p) {
//         $commande->addProduit($p);
//     }

//     $form = $this->createForm(CheckoutType::class, $commande, [
//         'client_data' => [
//             'email' => $client->getClientEmail(),
//             'phone' => $client->getClientPhone(),
//             'adresse' => $client->getAdresseLivraison(),
//             'postal' => $client->getCodePostalLivraison(),
//         ]
//     ]);

//     $form->handleRequest($request);

//     if ($form->isSubmitted() && $form->isValid()) {
//         // Decide to use existing or new info
//         $client_email = $request->get('use_existing_email') === 'yes' ? $client->getClientEmail() : $form->get('client_email')->getData();
//         $client_phone = $request->get('use_existing_phone') === 'yes' ? $client->getClientPhone() : $form->get('client_phone')->getData();
//         $adresse = $request->get('use_existing_address') === 'yes' ? $client->getAdresseLivraison() : $form->get('adresseLivraison')->getData();
//         $postal = $request->get('use_existing_postal') === 'yes' ? $client->getCodePostalLivraison() : $form->get('codePostalLivraison')->getData();

//         $client->setClientEmail($client_email);
//         $client->setClientPhone($client_phone);
//         $client->setAdresseLivraison($adresse);
//         $client->setCodePostalLivraison($postal);

//         $entityManager->persist($client);
//         $entityManager->persist($commande);

//         // Create Facture
//         $facture = new Factures();
//         $facture->setCommande($commande);                 // link to the order
//         $facture->setMontantTotal($commande->getPrixTotal()); // set total amount
//         $facture->setDateFacture(new \DateTime());        // set current date
//         $facture->setStatutPaiement('En attente');       // set payment status



//         $entityManager->persist($facture);
//         $entityManager->flush();

//         $panier->clear();
//         $this->addFlash('success', 'Votre commande a été enregistrée avec succès.');
//         return $this->redirectToRoute('main_panier');
//     }

//     return $this->render('panier.html.twig', [
//         'panier' => $panier_complet,
//         'totalPrice' => $total,
//         'form' => $form->createView(),
//         'client' => $client
//     ]);
// }




#[Route('/panier', name: 'main_panier')]
public function panier(
    Request $request,
    Panier $panier,
    ProduitsRepository $repo,
    ClientsRepository $clientsRepository,
    Security $security,
    EntityManagerInterface $entityManager,
    MailerService $mailer,
    TwigEnvironment $twig
): Response {
    $user = $security->getUser();
    if (!$user) return $this->redirectToRoute('app_login');

    $client = $clientsRepository->findOneBy(['user' => $user]);
    if (!$client) return $this->redirectToRoute('app_register');

    $panier_complet = [];
    $total = 0;
    $quantite_totale = 0;
    $produits = [];

    foreach ($panier->liste() as $id => $quantite) {
        $produit = $repo->find($id);
        if ($produit) {
            $panier_complet[] = ['produit' => $produit, 'quantite' => $quantite];
            $total += $produit->getVentPrix() * $quantite;
            $quantite_totale += $quantite;
            $produits[] = $produit;
        }
    }

    if (count($produits) === 0) {
        $this->addFlash('warning', 'Votre panier est vide.');
        return $this->render('panier.html.twig', [
            'panier' => $panier_complet,
            'totalPrice' => $total,
            'form' => null
        ]);
    }

    $commande = new Commandes();
    $commande->setClient($client);
    $commande->setPrixTotal($total);
    $commande->setQuantite($quantite_totale);
    foreach ($produits as $p) $commande->addProduit($p);

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
        // Save client info if empty
        if (!$client->getClientEmail()) $client->setClientEmail($form->get('client_email')->getData());
        if (!$client->getClientPhone()) $client->setClientPhone($form->get('client_phone')->getData());
        if (!$client->getAdresseLivraison()) $client->setAdresseLivraison($form->get('adresseLivraison')->getData());
        if (!$client->getCodePostalLivraison()) $client->setCodePostalLivraison($form->get('codePostalLivraison')->getData());

        $entityManager->persist($client);
        $entityManager->persist($commande);

        // Create facture
        $facture = new Factures();
        $facture->setCommande($commande);
        $facture->setDateFacture(new \DateTime());
        $facture->setMontantTotal($commande->getPrixTotal());
        $facture->setStatutPaiement('En attente');
        $entityManager->persist($facture);

        $entityManager->flush();

        $panier->clear();
        $this->addFlash('success', 'Votre commande a été enregistrée avec succès.');

        // --- Send email based on client type ---
        $email = $client->getClientEmail();
        if ($client->getTypeClient() === 'professional') {
            // Render detailed invoice template
            $content = $twig->render('emails/facture_pro.html.twig', [
                'client' => $client,
                'commande' => $commande,
                'facture' => $facture,
            ]);
            $mailer->sendEmail($email, $content, 'Votre facture détaillée');
        } else {
            // Private client, simple confirmation
            $content = $twig->render('emails/confirmation_prive.html.twig', [
                'client' => $client,
                'commande' => $commande,
            ]);
            $mailer->sendEmail($email, $content, 'Confirmation de votre commande');
        }

        return $this->redirectToRoute('main_panier');
    }

    return $this->render('panier.html.twig', [
        'panier' => $panier_complet,
        'totalPrice' => $total,
        'form' => $form->createView(),
        'client' => $client
    ]);
}



    #[Route('/panier/add/{id}', name: 'main_add_panier')]
    public function add(Produits $produit, Panier $panier, Request $request): Response
    {
        $panier->add($produit->getId());

        //this will redirect back to the page the user came from
        $referer = $request->headers->get('referer');
        return $referer ? $this->redirect($referer) : $this->redirectToRoute('main');
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
