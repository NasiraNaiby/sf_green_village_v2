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



final class ClientContorller extends AbstractController
{
  
    #[Route('/spaceclient', name: 'spaceclient')]
    public function spaceClient(): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('client_contorller/index.html.twig');
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


}
