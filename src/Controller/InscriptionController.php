<?php

namespace App\Controller;

use App\Entity\Inscription;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(): Response
    {
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }

    #[Route('/api/inscription/{id}', name: 'app_inscription_list')]
    public function inscription(EntityManagerInterface $entityManager, $id, SerializerInterface $serializer): JsonResponse
    {
        $inscription = $entityManager->getRepository(Inscription::class)->find($id);

        if (!$inscription) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        $jsonContent = $serializer->serialize($inscription, 'json', ['groups' => ['inscription']]);
        return JsonResponse::fromJsonString($jsonContent);
    }

    #[Route('/api/inscriptions', name: 'app_inscriptions_list')]
    public function inscriptions(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $inscription = $entityManager->getRepository(Inscription::class)->findAll();

        if (!$inscription) {
            throw $this->createNotFoundException(
                'No product found for all inscriptions'
            );
        }

        $jsonContent = $serializer->serialize($inscription, 'json', ['groups' => ['inscription']]);
        return JsonResponse::fromJsonString($jsonContent);
    }
}
