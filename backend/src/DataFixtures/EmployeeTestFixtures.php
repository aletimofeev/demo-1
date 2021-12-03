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
use App\Entity\Employee;
use App\Entity\Position;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class EmployeeTestFixtures extends Fixture
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function load(ObjectManager $manager): void
    {
        $data = require 'data/employees.php';

        foreach ($data as $item) {
            $lastname = $firstname = $patronymic = $email =
            $birthDate = $departmentName = $positionName1 = '';

            try {
                list(
                    $lastname, $firstname, $patronymic, $birthDate,
                    $email, $departmentName, $positionName1, $positionName2
                    ) = explode(' ', $item);
                $positionName = $positionName1 . ' ' . $positionName2;
            } catch (\Exception $e) {
                $positionName = $positionName1;
            }

            $department = $this->findDepartment(trim($departmentName));
            $position = $this->findPosition(trim($positionName));

            $employee = new Employee();
            $employee
                ->setLastname(trim($lastname))
                ->setFirstname(trim($firstname))
                ->setPatronymic(trim($patronymic))
                ->setBirthDate(new \DateTime($birthDate))
                ->setEmail(trim($email))
                ->setDepartment($department)
                ->setPosition($position);

            $manager->persist($employee);
        }

        $manager->flush();
    }

    private function findDepartment(string $name): Department
    {
        return $this->em->getRepository(Department::class)
            ->findOneBy(['name' => $name]);
    }

    private function findPosition(string $name): ?Position
    {
        return $this->em->getRepository(Position::class)
            ->findOneBy(['name' => $name]);
    }
}
