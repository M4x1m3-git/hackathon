<?php

namespace App\DataFixtures;

use App\Entity\Hackathon;
use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjetFixtures extends Fixture implements DependentFixtureInterface
{
    public const NB_PROJ = 3;
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $projet = new Projet();
            $projet->setDescription('Exemple');
            $projet->setRetenu(rand(0, 1));

            $hack_id = random_int(0, HackathonFixtures::NB_HACK - 1);
            $hack = $this->getReference('hackathon_'.$hack_id, Hackathon::class);
            $projet->setHackathon($hack);

            $manager->persist($projet);

            $this->addReference('projet_'.$i, $projet);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            HackathonFixtures::class
        ];
    }
}
