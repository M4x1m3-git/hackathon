<?php

namespace App\DataFixtures;

use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjetFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $projet = new Projet();
            $projet->setDescription('Exemple');
            $projet->setRetenu(rand(0, 1));
            $manager->persist($projet);
        }

        $manager->flush();
    }
}
