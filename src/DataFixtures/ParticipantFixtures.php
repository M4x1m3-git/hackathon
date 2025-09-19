<?php

namespace App\DataFixtures;

use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ParticipantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $participant = new Participant();
            $participant->setDateNaissance(new \DateTime('now'));
            $participant->setLienPortefolio('');
            $manager->persist($participant);
        }

        $manager->flush();
    }
}
