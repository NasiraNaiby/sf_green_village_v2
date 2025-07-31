<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserStatusController extends AbstractController
{
    #[Route('/api/user-status', name: 'api_user_status')]
    public function userStatus(): JsonResponse
    {
        $user = $this->getUser();

        return $this->json([
            'isAuthenticated' => $user !== null,
            'username' => $user?->getUserIdentifier(),
        ]);
    }
}