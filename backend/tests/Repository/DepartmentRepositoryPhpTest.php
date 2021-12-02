<?php

namespace App\Tests\Repository;

use App\Entity\Department;
use App\Repository\DepartmentRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DepartmentRepositoryPhpTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;
    private ?DepartmentRepository $repository;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->repository = $this->entityManager->getRepository(Department::class);
    }

    public function testCount()
    {
        $departments = $this->repository->findAll();

        $this->assertCount(4, $departments);
    }

    public function testSearchByName()
    {
        $department = $this->repository
            ->findOneBy(['name' => 'Продажи']);

        $this->assertNotNull($department);;
        $this->assertSame('Продажи', $department->getName());
    }


    /**
     * @dataProvider namesProvider
     */
    public function testOrderByName($index, $expected)
    {
        $departments = $this->repository
            ->findBy([], ['name' => 'ASC']);

        $this->assertSame($expected, $departments[$index]->getName());
    }

    public function namesProvider(): array
    {
        return [
            'name_1' => [0, 'IT'],
            'name_2' => [1, 'Закупки'],
            'name_3' => [2, 'Продажи'],
            'name_4' => [3, 'Реклама'],
        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
        $this->repository = null;
    }
}
