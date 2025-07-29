<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ReactController extends AbstractController
{
    // #[Route('/{reactRouting}', name: 'app_main', requirements: ['reactRouting' => '.*'])]
    // public function index(): Response
    // {
    //     return $this->render('react/index.html.twig', [
    //         'controller_name' => 'ReactController',
    //     ]);
    // }


   // src/Controller/ReactController.php

    // #[Route('/app/{reactRouting}', name: 'app_main', requirements: ['reactRouting' => '.*'], defaults: ['reactRouting' => ''])]
    // public function index(): Response
    // {
    //     return $this->render('react/index.html.twig');
    // }

    #[Route('/{reactRouting}', name: 'react_app', requirements: ['reactRouting' => '^(spaceclient|dashboard|profile|otherroutes)$'], defaults: ['reactRouting' => null])]
    public function index(): Response
    {
        return $this->file('../public/index.html');
    }


}
