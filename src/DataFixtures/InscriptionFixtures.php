<?php

namespace App\DataFixtures;

use App\Entity\Inscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $inscription = new Inscription();
            $inscription->setNum($i);
            $inscription->setDate(new \DateTime('now'));
            $inscription->setCompetence('php');
            $manager->persist($inscription);
        }

        $manager->flush();
    }
}
