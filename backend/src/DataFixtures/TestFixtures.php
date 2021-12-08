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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TestFixtures extends Fixture
{
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $departmentFixtures = new DepartmentFixtures();
        $departmentFixtures->load($manager);

        $positionFixtures = new PositionFixtures();
        $positionFixtures->load($manager);

        $employeeFixtures = new EmployeeTestFixtures($this->entityManager);
        $employeeFixtures->load($manager);

        $userFixtures = new UserFixtures($this->passwordHasher);
        $userFixtures->load($manager);
    }
}
