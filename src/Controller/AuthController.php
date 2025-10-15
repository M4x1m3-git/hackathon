<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class AuthController extends AbstractController
{
    #[Route('/auth', name: 'app_auth')]
    public function index(): Response
    {
        return $this->render('auth/index.html.twig', [
            'controller_name' => 'AuthController',
        ]);
    }
    #[Route('/api/login', name: 'app_user', methods: ['GET'])]
    public function inscription(EntityManagerInterface $entityManager, $id, SerializerInterface $serializer): JsonResponse
    {
        $login = $entityManager->getRepository(User::class)->find($id);

        if (!$login) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        $jsonContent = $serializer->serialize($login, 'json', ['groups' => ['user']]);
        return JsonResponse::fromJsonString($jsonContent);
    }

    #[Route('/api/login', name: 'app_user_create', methods: ['POST'])]
    public function createUser(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse {
        $data = $request->getContent();

        $login = $serializer->deserialize($data, User::class, 'json');

        $errors = $validator->validate($login);
        if (count($errors) > 0) {
            return new JsonResponse((string) $errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        $entityManager->persist($login);
        $entityManager->flush();

        $jsonContent = $serializer->serialize($login, 'json', ['groups' => ['user']]);
        return new JsonResponse($jsonContent, JsonResponse::HTTP_CREATED, [], true);
    }
}
