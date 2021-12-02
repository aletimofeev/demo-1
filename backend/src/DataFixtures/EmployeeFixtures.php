<?php

namespace App\DataFixtures;

use App\Entity\Department;
use App\Entity\Employee;
use App\Entity\Position;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;


class EmployeeFixtures extends Fixture
{
    /** @var \App\Entity\Department[] */
    private array $departments;
    /** @var \App\Entity\Position[] */
    private array $positions;
    private Generator $faker;

    public function __construct(EntityManagerInterface $em)
    {
        $this->departments = $em->getRepository(Department::class)
            ->findAll();
        $this->positions = $em->getRepository(Position::class)
            ->findAll();
        $this->faker = Factory::create('ru_RU');
    }


    public function load(ObjectManager $manager): void
    {
        foreach ($this->departments as $department) {
            foreach ($this->positions as $position) {
                $employee = $this->getEmployee($department, $position);
                $manager->persist($employee);
            }
        }

        $manager->flush();
    }

    private function getEmployee(Department $department, Position $position): Employee
    {
        $employee = new Employee();
        $employee
            ->setLastname($this->faker->lastName)
            ->setFirstname($this->faker->firstName)
            ->setPatronymic($this->faker->firstName)
            ->setBirthDate($this->faker->dateTimeBetween('-60 years', '-20 years'))
            ->setPosition($position)
            ->setDepartment($department);

        return $employee;
    }
}