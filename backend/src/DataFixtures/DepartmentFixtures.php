<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepartmentFixtures extends Fixture
{
    public const DEPARTMENTS = ['Продажи', 'Закупки', 'IT', 'Реклама'];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DEPARTMENTS as $name) {
            $department = new Department();
            $department->setName($name);
            $manager->persist($department);
        }

        $manager->flush();
    }
}
