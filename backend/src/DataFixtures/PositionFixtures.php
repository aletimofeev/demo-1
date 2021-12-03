<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataFixtures;

use App\Entity\Position;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PositionFixtures extends Fixture
{
    public const NAMES = ['Руководитель', 'Старший специалист', 'Младший специалист'];

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
