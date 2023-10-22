<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('/api')]
class SecurityController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {}

    #[Route('/login', name: 'user_login', methods: 'POST')]
    public function login(#[CurrentUser] User $user = null): Response
    {
        try {
            $user->setToken(\bin2hex(\random_bytes(60)));
            $this->entityManager->flush();
        } catch (\Exception) {
            return new JsonResponse([
                'message' => 'Failed to log-in user. Try again later.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json([
            'token' => $user->getToken() ?? null,
        ]);
    }
}
