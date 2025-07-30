<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ReactController extends AbstractController
{

    #[Route('/app/{reactRouting}', name: 'app_main', requirements: ['reactRouting' => '.*'], defaults: ['reactRouting' => ''])]
    public function index(): Response
    {
        return $this->render('react/index.html.twig');
    }

}
