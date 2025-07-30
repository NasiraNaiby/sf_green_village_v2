<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ClientContorller extends AbstractController
{
  
    #[Route('/app/spaceclient', name: 'spaceclient')]
    public function spaceClient(): Response
    {
        return $this->render('client_contorller/index.html.twig');
    }

}
