<?php

namespace App\DataFixtures;

use App\Entity\Hackathon;
use App\Entity\Organisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class HackathonFixtures extends Fixture implements DependentFixtureInterface
{
    public const NB_HACK = 3;
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $hackathon = new Hackathon();
            $hackathon->setDateHeureDebut(new \DateTime('now'));
            $hackathon->setDateHeureFin(new \DateTime('now'));
            $hackathon->setLieu('Centre');
            $hackathon->setVille('Nantes');
            $hackathon->setTheme('Art');

            $orga_id = random_int(0, OrganisateurFixtures::NB_ORGA - 1);
            $orga = $this->getReference('organisateur_'.$orga_id, Organisateur::class);
            $hackathon->setOrganisateur($orga);

            $manager->persist($hackathon);

            $this->addReference('hackathon_'.$i, $hackathon);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            OrganisateurFixtures::class
        ];
    }
}
