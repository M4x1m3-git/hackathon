<?php

namespace App\Controller;

use App\Entity\Hackathon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class HackathonController extends AbstractController
{
    #[Route('/hackathon', name: 'app_hackathon', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('hackathon/index.html.twig', [
            'controller_name' => 'HackathonController',
        ]);
    }

    #[Route('/api/hackathon/{id}', name: 'app_hackathon_list', methods: ['GET'])]
    public function hackathon(EntityManagerInterface $entityManager, $id, SerializerInterface $serializer): JsonResponse
    {
        $hackathon = $entityManager->getRepository(Hackathon::class)->find($id);

        if (!$hackathon) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $jsonContent = $serializer->serialize($hackathon, 'json', ['groups' => ['hackathon']]);
        return JsonResponse::fromJsonString($jsonContent);
        //        return $this->json([
//            'Id' => $hackathon->getId(),
//            'Lieu' => $hackathon->getLieu(),
//            'Ville' => $hackathon->getVille(),
//            'DateHeureDebut' => $hackathon->getDateHeureDebut(),
//            'DateHeureFin' => $hackathon->getDateHeureFin(),
//            'Theme' => $hackathon->getTheme(),
//            'Organisateur' => $hackathon->getOrganisateur(),
//            'Projets' => $hackathon->getProjets(),
//            'Inscriptions' => $hackathon->getInscriptions()
//        ]);
        // return new Response('Lieu du hackathon : '.$hackathon->getLieu());
    }

    #[Route('/api/hackathons', name: 'app_hackathons_list', methods: ['GET'])]
    public function hackathons(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $hackathon = $entityManager->getRepository(Hackathon::class)->findAll();

        if (!$hackathon) {
            throw $this->createNotFoundException(
                'No product found for all hackathons'
            );
        }

        $jsonContent = $serializer->serialize($hackathon, 'json', ['groups' => ['hackathon']]);
        return JsonResponse::fromJsonString($jsonContent);
    }

//    #[Route('/api/hackathons/{id}', name: 'app_hackathon_update', methods: ['PUT'])]
//    public function updateHackathon(int $id, Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse {
//        $hackathon = $entityManager->getRepository(Hackathon::class)->find($id);
//
//        if (!$hackathon) {
//            return new JsonResponse(['message' => 'Hackathon not found'], JsonResponse::HTTP_NOT_FOUND);
//        }
//
//        $serializer->deserialize($request->getContent(), Hackathon::class, 'json', [
//            'object_to_populate' => $hackathon,
//        ]);
//
//        $errors = $validator->validate($hackathon);
//        if (count($errors) > 0) {
//            return new JsonResponse((string) $errors, JsonResponse::HTTP_BAD_REQUEST);
//        }
//
//        $entityManager->flush();
//
//        $jsonContent = $serializer->serialize($hackathon, 'json', ['groups' => ['hackathon']]);
//        return new JsonResponse($jsonContent, JsonResponse::HTTP_OK, [], true);
//    }
//
//    #[Route('/api/hackathons', name: 'app_hackathon_create', methods: ['POST'])]
//    public function createHackathon(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse {
//        $data = $request->getContent();
//
//        $hackathon = $serializer->deserialize($data, Hackathon::class, 'json');
//
//        $errors = $validator->validate($hackathon);
//        if (count($errors) > 0) {
//            return new JsonResponse((string) $errors, JsonResponse::HTTP_BAD_REQUEST);
//        }
//
//        $entityManager->persist($hackathon);
//        $entityManager->flush();
//
//        $jsonContent = $serializer->serialize($hackathon, 'json', ['groups' => ['hackathon']]);
//        return new JsonResponse($jsonContent, JsonResponse::HTTP_CREATED, [], true);
//    }
//
//    #[Route('/api/hackathons/{id}', name: 'app_hackathon_delete', methods: ['DELETE'])]
//    public function deleteHackathon(int $id, EntityManagerInterface $entityManager): JsonResponse {
//        $hackathon = $entityManager->getRepository(Hackathon::class)->find($id);
//
//        if (!$hackathon) {
//            return new JsonResponse(['message' => 'Hackathon not found'], JsonResponse::HTTP_NOT_FOUND);
//        }
//
//        $entityManager->remove($hackathon);
//        $entityManager->flush();
//
//        return new JsonResponse(['message' => 'Hackathon deleted'], JsonResponse::HTTP_NO_CONTENT);
//    }

}
