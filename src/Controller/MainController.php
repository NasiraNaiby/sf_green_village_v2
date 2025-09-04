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
use Dompdf\Dompdf;
use App\Repository\FournisseursRepository;



final class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(CategoriesRepository $categories, ProduitsRepository $produit): Response
    {
        $limitedCategories = $categories->findBy([], null, 4); 
        $produits = $produit->findAll();

        return $this->render('accueil.html.twig', [
            'categories' => $limitedCategories,
                'produits' =>$produits
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
    public function panier(
        Request $request,
        Panier $panier,
        ProduitsRepository $repo,
        ClientsRepository $clientsRepository,
        Security $security,
        EntityManagerInterface $entityManager,
        MailerService $mailer, // use your service
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

            // --- Generate PDF for professional clients ---
            if ($client->getTypeClient() === 'professional') {
                $htmlPdf = $twig->render('emails/facture_pro.html.twig', [
                    'client' => $client ,
                    'commande' => $commande,
                    'facture' => $facture,
                ]);

                $dompdf = new Dompdf();
                $dompdf->loadHtml($htmlPdf);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                $pdfOutput = $dompdf->output();

                $htmlEmail = $twig->render('emails/facture_pro.html.twig', [
                    'client' => $client,
                    'commande' => $commande,
                    'facture' => $facture,
                ]);

                $mailer->sendEmail(
                    $client->getClientEmail(),
                    $htmlEmail,
                    'Votre facture détaillée',
                    $pdfOutput,
                    'facture.pdf'
                );
            } else {
                $htmlEmail = $twig->render('emails/confirmation_prive.html.twig', [
                    'client' => $client,
                    'commande' => $commande,
                ]);

                $mailer->sendEmail(
                    $client->getClientEmail(),
                    $htmlEmail,
                    'Confirmation de votre commande'
                );
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
    #[Route('/search', name: 'search')]
    public function search(Request $request, ProduitsRepository $produitsRepository): Response
    {
        $searchTerm = $request->query->get('q', '');

        $results = [];
        if ($searchTerm !== '') {
            $results = $produitsRepository->searchByProduitOrCategorie($searchTerm);
        }

        return $this->render('search_results.html.twig', [
            'results' => $results,
            'searchTerm' => $searchTerm,
        ]);
    }


   #[Route('/wishlist/toggle/{id}', name: 'wishlist_toggle', methods: ['POST'])]
    public function toggle(Produits $produit, EntityManagerInterface $em, Request $request): JsonResponse
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['status' => 'error', 'message' => 'Utilisateur non connecté'], 403);
        }

        $client = $user->getClient();
        if (!$client) {
            return $this->json(['status' => 'error', 'message' => 'Client introuvable'], 404);
        }

        if ($client->getFavoris()->contains($produit)) {
            $client->removeFavoris($produit);
            $action = 'removed';
        } else {
            $client->addFavoris($produit);
            $action = 'added';
        }

        $em->persist($client);
        $em->flush();

        return $this->json([
            'status' => 'success',
            'action' => $action,
            'produit_id' => $produit->getId()
        ]);
    }

    #[Route('/produit/details/{id}', name: 'produit_details')]
    public function details(ProduitsRepository $repo, int $id): JsonResponse {
        $produit = $repo->find($id);

        return $this->json([
            'nomProduit' => $produit->getNomProduit(),
            'descProduit' => $produit->getDescProduit(),
            'ventPrix' => $produit->getVentPrix(),
            'photo' => $produit->getPhoto() // single image URL
        ]);
    }

    #[Route('/categorie/{id}', name: 'categorie_details')]
    public function categorieDetails(CategoriesRepository $categories, int $id): Response
    {
        $categorie = $categories->find($id);

        if (!$categorie) {
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        return $this->render('cat_detail.html.twig', [
            'categorie' => $categorie,
        ]);
    }

   

    #[Route('/fournisseur/{id}', name: 'fournisseur_details')]
    public function fournisseurDetails(FournisseursRepository $fournisseurs, int $id): Response
    {
        $fournisseur = $fournisseurs->find($id);

        if (!$fournisseur) {
            throw $this->createNotFoundException('Fournisseur non trouvé');
        }

        return $this->render('fournisseur_detail.html.twig', [
            'fournisseur' => $fournisseur,
        ]);
    }



}
