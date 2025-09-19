<?php

namespace App\DataFixtures;

use App\Entity\Organisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrganisateurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $organisateur = new Organisateur();
            $organisateur->setStatut('Professeur');
            $organisateur->setNom('Bob');
            $organisateur->setSiteWeb('');
            $organisateur->setEmail('bob@example.com');
            $manager->persist($organisateur);
        }

        $manager->flush();
    }
}
