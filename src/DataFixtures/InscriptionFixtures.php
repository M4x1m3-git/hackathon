<?php

namespace App\DataFixtures;

use App\Entity\Equipe;
use App\Entity\Hackathon;
use App\Entity\Inscription;
use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class InscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $inscription = new Inscription();
            $inscription->setNum($i);
            $inscription->setDate(new \DateTime('now'));
            $inscription->setCompetence('php');

            $hack_id = random_int(0, HackathonFixtures::NB_HACK - 1);
            $hack = $this->getReference('hackathon_'.$hack_id, Hackathon::class);
            $inscription->setHackathon($hack);

            $part_id = random_int(0, ParticipantFixtures::NB_PART - 1);
            $part = $this->getReference('participant_'.$part_id, Participant::class);
            $inscription->setParticipant($part);


            $equipe_id = random_int(0, EquipeFixtures::NB_EQUIPE - 1);
            $equipe = $this->getReference('equipe_'.$equipe_id, Equipe::class);
            $inscription->setEquipe($equipe);

            $manager->persist($inscription);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            HackathonFixtures::class,
            ParticipantFixtures::class,
            EquipeFixtures::class
        ];
    }
}
