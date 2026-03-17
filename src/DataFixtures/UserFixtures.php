<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('referent@test.fr');
        $user->setPassword('\$2y\$13\$DNONPigOMFm7Xc1ywX.k3.d77r1Za.F2PQLjRZFILC9YCkjPi9Mo.'); // password_test

        $manager->persist($user);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProjetFixtures::class
        ];
    }
}
