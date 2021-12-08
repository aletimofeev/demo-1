<?php

namespace App\Tests\Api\Employees;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\Api\ApiHelperTrait;
use App\Tests\Api\Hydra;

class EmployeesSortTest extends ApiTestCase
{
    use ApiHelperTrait;

    public const URL = '/api/employees';

    public function testLastnameDescSort(): void
    {
        $response = $this->requestAsUser(self::URL.'?order[lastname]=desc');
        $data = $response->toArray();
        $members = $data[Hydra::MEMBERS];

        $firstItem = $members[0];
        $this->assertSame('Ольгина', $firstItem['lastname']);

        $lastItem = $members[array_key_last($members)];
        $this->assertSame('Антонов', $lastItem['lastname']);
    }

    public function testBirtDateDescSort(): void
    {
        $response = $this->requestAsUser(self::URL.'?order[birthDate]=desc');
        $data = $response->toArray();

        $members = $data[Hydra::MEMBERS];

        $firstItem = $members[0];
        $this->assertSame('Марьина', $firstItem['lastname']);

        $lastItem = $members[array_key_last($members)];
        $this->assertSame('Антонов', $lastItem['lastname']);
    }

    public function testBirtDateAscSort(): void
    {
        $response = $this->requestAsEditor(self::URL.'?order[birthDate]=asc');
        $data = $response->toArray();

        $members = $data[Hydra::MEMBERS];

        $firstItem = $members[0];
        $this->assertSame('Антонов', $firstItem['lastname']);

        $lastItem = $members[array_key_last($members)];
        $this->assertSame('Марьина', $lastItem['lastname']);
    }

    public function testDepartmentLastnameAscSort(): void
    {
        $response = $this->requestAsEditor(
            self::URL.'?order[department.name]=asc&order[lastname]=asc'
        );
        $data = $response->toArray();

        $members = $data[Hydra::MEMBERS];

        $firstItem = $members[0];
        $this->assertSame('Заикина', $firstItem['lastname']);

        $lastItem = $members[array_key_last($members)];
        $this->assertSame('Ольгина', $lastItem['lastname']);
    }

    public function testDepartmentAscLastnameDescSort(): void
    {
        $response = $this->requestAsEditor(
            self::URL.'?order[department.name]=asc&order[lastname]=desc'
        );
        $data = $response->toArray();

        $members = $data[Hydra::MEMBERS];

        $firstItem = $members[0];
        $this->assertSame('Катеринова', $firstItem['lastname']);

        $lastItem = $members[array_key_last($members)];
        $this->assertSame('Марьина', $lastItem['lastname']);
    }
}
