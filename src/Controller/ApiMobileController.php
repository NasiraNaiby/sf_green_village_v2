<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApiMobileController extends AbstractController
{
    #[Route('/api/mobile', name: 'app_api_mobile')]
    public function index(): Response
    {
        return $this->render('api_mobile/index.html.twig', [
            'controller_name' => 'ApiMobileController',
        ]);
    }
}
