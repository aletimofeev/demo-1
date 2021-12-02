<?php

namespace App\DataFixtures;

use App\Entity\Position;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PositionFixtures extends Fixture
{
    const NAMES = ['Руководитель', 'Старший специалист', 'Младший специалист'];

    public function load(ObjectManager $manager): void
    {
        foreach (self::NAMES as $name) {
            $position = new Position();
            $position->setName($name);

            $manager->persist($position);
        }

        $manager->flush();
    }
}
