<?php

namespace App\DataFixtures;

use App\Entity\Hackathon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HackathonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $hackathon = new Hackathon();
            $hackathon->setDateHeureDebut(new \DateTime('now'));
            $hackathon->setDateHeureFin(new \DateTime('now'));
            $hackathon->setLieu('Centre');
            $hackathon->setVille('Nantes');
            $hackathon->setTheme('Art');
            $manager->persist($hackathon);
        }

        $manager->flush();
    }
}
