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

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepartmentFixtures extends Fixture
{
    public const NAMES = ['Продажи', 'Закупки', 'IT', 'Реклама'];

    public function load(ObjectManager $manager): void
    {
        foreach (self::NAMES as $name) {
            $department = new Department();
            $department->setName($name);
            $manager->persist($department);
        }

        $manager->flush();
    }
}
