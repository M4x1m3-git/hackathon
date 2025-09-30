<?php

namespace App\Controller;

use App\Entity\Hackathon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class HackathonController extends AbstractController
{
    #[Route('/hackathon', name: 'app_hackathon')]
    public function index(): Response
    {
        return $this->render('hackathon/index.html.twig', [
            'controller_name' => 'HackathonController',
        ]);
    }

    #[Route('/api/hackathon/{id}', name: 'app_hackathon_list')]
    public function hackathon(EntityManagerInterface $entityManager, $id, SerializerInterface $serializer): JsonResponse
    {
        $hackathon = $entityManager->getRepository(Hackathon::class)->find($id);

        if (!$hackathon) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $jsonContent = $serializer->serialize($hackathon, 'json');
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
}
