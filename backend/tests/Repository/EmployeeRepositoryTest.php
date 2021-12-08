<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Repository;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EmployeeRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;
    private ?EmployeeRepository $repository;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->repository = $this->entityManager->getRepository(Employee::class);
    }

    public function testFindByIds()
    {
        $employees = $this->repository->findBy([], ['lastname' => 'ASC'], ['limit' => 3]);
        $ids = array_map(fn ($item): int => $item->getId(), $employees);

        $finding = $this->repository->findBy(['id' => $ids]);
        $this->assertSame($employees, $finding);
    }

    public function testCount()
    {
        $employees = $this->repository->findAll();

        $this->assertCount(12, $employees);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
        $this->repository = null;
    }
}
