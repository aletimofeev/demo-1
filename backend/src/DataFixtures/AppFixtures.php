<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private EntityManagerInterface $entityManager;

    /**
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function load(ObjectManager $manager): void
    {
        $departmentFixtures = new DepartmentFixtures();
        $departmentFixtures->load($manager);

        $positionFixtures = new PositionFixtures();
        $positionFixtures->load($manager);

        $employeeFixtures = new EmployeeFixtures($this->entityManager);
        $employeeFixtures->load($manager);
    }
}
