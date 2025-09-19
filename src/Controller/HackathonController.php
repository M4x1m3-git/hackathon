<?php

namespace App\Controller;

use App\Entity\Hackathon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HackathonController extends AbstractController
{
    #[Route('/hackathon', name: 'app_hackathon')]
    public function index(): Response
    {
        return $this->render('hackathon/index.html.twig', [
            'controller_name' => 'HackathonController',
        ]);
    }

    #[Route('/api/hackathons/{id}', name: 'app_hackathon_list')]
    public function hackathons(EntityManagerInterface $entityManager, $id): Response
    {
        $hackathons = $entityManager->getRepository(Hackathon::class)->find($id);

        if (!$hackathons) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }


        return new Response('Liste des hackathons : '.$hackathons->getLieu());
    }
}
