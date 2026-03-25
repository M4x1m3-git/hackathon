<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
    #[Route('/api/register', name: 'app_user_register', methods: ['POST'])]
    public function registerUser(
        Request $request,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        UserPasswordHasherInterface $passwordHasher
    ): JsonResponse {
        $data = $request->getContent();

        $user = $serializer->deserialize($data, User::class, 'json');

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return new JsonResponse((string) $errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        // 💡 Hasher le mot de passe !
        $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);

        $entityManager->persist($user);
        $entityManager->flush();

        $jsonContent = $serializer->serialize($user, 'json', ['groups' => ['user']]);
        return new JsonResponse($jsonContent, JsonResponse::HTTP_CREATED, [], true);
    }

}
