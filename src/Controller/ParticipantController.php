<?php

namespace App\Controller;

use App\Entity\Participant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ParticipantController extends AbstractController
{
    #[Route('/api/participant', name: 'app_participant')]
    public function index(): Response
    {
        return $this->render('participant/index.html.twig', [
            'controller_name' => 'ParticipantController',
        ]);
    }

    #[Route('/api/participants/{id}', name: 'app_participant_list', methods: ['GET'])]
    public function inscription(EntityManagerInterface $entityManager, $id, SerializerInterface $serializer): JsonResponse
    {
        $participant = $entityManager->getRepository(Participant::class)->find($id);

        if (!$participant) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        $jsonContent = $serializer->serialize($participant, 'json', ['groups' => ['participant']]);
        return JsonResponse::fromJsonString($jsonContent);
    }

    #[Route('/api/participants', name: 'app_participants_list', methods: ['GET'])]
    public function participants(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $participant = $entityManager->getRepository(Participant::class)->findAll();

        if (!$participant) {
            throw $this->createNotFoundException(
                'No product found for all participants'
            );
        }

        $jsonContent = $serializer->serialize($participant, 'json', ['groups' => ['participant']]);
        return JsonResponse::fromJsonString($jsonContent);
    }

    #[Route('/api/participants', name: 'app_participant_create', methods: ['POST'])]
    public function createParticipant(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse {
        $data = $request->getContent();

        $participant = $serializer->deserialize($data, Participant::class, 'json');

        $errors = $validator->validate($participant);
        if (count($errors) > 0) {
            return new JsonResponse((string) $errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        $entityManager->persist($participant);
        $entityManager->flush();

        $jsonContent = $serializer->serialize($participant, 'json', ['groups' => ['participant']]);
        return new JsonResponse($jsonContent, JsonResponse::HTTP_CREATED, [], true);
    }

    #[Route('/api/participants/{id}', name: 'app_participant_update', methods: ['PUT'])]
    public function updateParticipant(int $id, Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse {
        $participant = $entityManager->getRepository(Participant::class)->find($id);

        if (!$participant) {
            return new JsonResponse(['message' => 'Hackathon not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $serializer->deserialize($request->getContent(), Participant::class, 'json', [
            'object_to_populate' => $participant,
        ]);

        $errors = $validator->validate($participant);
        if (count($errors) > 0) {
            return new JsonResponse((string) $errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        $entityManager->flush();

        $jsonContent = $serializer->serialize($participant, 'json', ['groups' => ['participant']]);
        return new JsonResponse($jsonContent, JsonResponse::HTTP_OK, [], true);
    }

    #[Route('/api/participants/{id}', name: 'app_participant_delete', methods: ['DELETE'])]
    public function deleteParticipant(int $id, EntityManagerInterface $entityManager): JsonResponse {
        $participant = $entityManager->getRepository(Participant::class)->find($id);

        if (!$participant) {
            return new JsonResponse(['message' => 'Participant not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $entityManager->remove($participant);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Participant deleted'], JsonResponse::HTTP_NO_CONTENT);
    }
}
