<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Form\InscriptionType;
use App\Entity\Clients;
use App\Form\ClientType;
use App\Repository\CommandesRepository;
use App\Entity\Commandes;



final class ClientController extends AbstractController
{
  
 
#[Route('/spaceclient', name: 'spaceclient')]
public function spaceClient(
    Request $request,
    EntityManagerInterface $em,
    CommandesRepository $commandRepo
): Response {
    $user = $this->getUser();
    $client = $user->getClient();

    if (!$client) {
        $client = new Clients();
        $client->setUser($user);
    }

    // Fetch only this user's commandes
    $commandes = $commandRepo->findBy(['client' => $client]);

    // ✅ fetch favoris (wishlist)
    $favoris = $client->getFavoris(); // assuming relation ManyToMany with Produits

    $form = $this->createForm(ClientType::class, $client);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $user->setUserName($form->get('user_name')->getData());

        $em->persist($user);
        $em->persist($client);
        $em->flush();

        $this->addFlash('success', 'Informations mises à jour avec succès !');
        return $this->redirectToRoute('spaceclient');
    }

    return $this->render('client_controller/index.html.twig', [
        'client' => $client,
        'form' => $form->createView(),
        'commandes' => $commandes,
        'favoris' => $favoris,  
    ]);
}





   

 #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $em): Response
    {
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(['ROLE_CLIENT']);
            $user->setPassword(
                $hasher->hashPassword($user, $user->getPassword())
            );

            $client = $user->getClient();
            $client->setUser($user); // Link back

            $em->persist($user);
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('app_login'); 
        }

        return $this->render('registeration.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     #[Route('/commande/delete/{id}', name: 'commande_delete')]
    public function deleteCommande(Commandes $commande, EntityManagerInterface $em): Response
    {
        $em->remove($commande);
        $em->flush();

        $this->addFlash('success', 'Commande supprimée avec succès !');
        return $this->redirectToRoute('spaceclient', ['tab' => 'tab2']);
    }


}
