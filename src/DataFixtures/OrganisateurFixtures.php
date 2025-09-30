<?php

namespace App\DataFixtures;

use App\Entity\Hackathon;
use App\Entity\Organisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrganisateurFixtures extends Fixture
{
    public const NB_ORGA = 3;
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $organisateur = new Organisateur();
            $organisateur->setStatut('Professeur');
            $organisateur->setNom('Bob');
            $organisateur->setSiteWeb('');
            $organisateur->setEmail('bob@example.com');
            $manager->persist($organisateur);

            $this->addReference('organisateur_'.$i, $organisateur);
        }

        $manager->flush();
    }
}
