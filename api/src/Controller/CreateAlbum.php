<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Entity\Album;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class CreateAlbum extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {}

    public function __invoke(Request $request): Response
    {
        $data = \json_decode($request->getContent(), true);

        if (!$data) {
            return new JsonResponse([
                'massage' => 'Invalid data!'
            ], Response::HTTP_BAD_REQUEST);
        }

        $album = Album::createFromArray($data);
        $album->setOwnerId($this->getUser());

        $this->entityManager->persist($album);
        $this->entityManager->flush();

        return new JsonResponse([$album]);
    }
}
