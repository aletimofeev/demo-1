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

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class TestFixtures extends Fixture
{
    private EntityManagerInterface $entityManager;

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

        $employeeFixtures = new EmployeeTestFixtures($this->entityManager);
        $employeeFixtures->load($manager);
    }
}
