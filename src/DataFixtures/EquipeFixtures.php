<?php

namespace App\DataFixtures;

use App\Entity\Equipe;
use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EquipeFixtures extends Fixture implements DependentFixtureInterface
{
    public const NB_EQUIPE = 3;
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $equipe = new Equipe();
            $equipe->setNom('Tucana');
            $equipe->setLienPrototype('/');

            $proj_id = random_int(0, ProjetFixtures::NB_PROJ - 1);
            $projet = $this->getReference('projet_'.$proj_id, Projet::class);
            $equipe->setProjet($projet);

            $manager->persist($equipe);

            $this->addReference('equipe_'.$i, $equipe);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProjetFixtures::class
        ];
    }
}
