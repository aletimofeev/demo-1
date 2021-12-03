<?php

namespace App\Tests\Api\Employees;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\Api\Hydra;

class EmployeesPaginationTest extends ApiTestCase
{
    public const URL = '/api/employees';

    public function testPerPage(): void
    {
        $response = static::createClient()->request('GET', self::URL . '?itemsPerPage=2');

        $this->assertResponseIsSuccessful();
        $data = $response->toArray();

        $this->assertSame(12, $data[Hydra::TOTAL]);
        $this->assertCount(2, $data[Hydra::MEMBERS]);
    }

    public function testSecondPage(): void
    {
        $response = static::createClient()->request('GET', self::URL . '?itemsPerPage=2&page=2');
        $data = $response->toArray();
        $members = $data[Hydra::MEMBERS];

        $this->assertSame('Валерьев', $members[0]['lastname']);
        $this->assertSame('Григорьев', $members[1]['lastname']);
    }

    public function testSecondPageLastNameDescOrder(): void
    {
        $response = static::createClient()->request('GET', self::URL . '?itemsPerPage=2&page=2&order[lastname]=desc');
        $data = $response->toArray();
        $members = $data[Hydra::MEMBERS];

        $this->assertSame('Марьина', $members[0]['lastname']);
        $this->assertSame('Катеринова', $members[1]['lastname']);
    }
}
