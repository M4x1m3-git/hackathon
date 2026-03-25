<?php

namespace App\DataFixtures;

use App\Entity\Membre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MembreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $membre = new Membre();
            $membre->setNom('Nom');
            $membre->setPrenom('Prenom');
            $membre->setEmail('test@example.com');
            $membre->setTelephone('+33 102030405');
            $manager->persist($membre);
        }

        $manager->flush();
    }
}
