<?php

namespace App\Tests\Api\Employees;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\Api\Hydra;

class EmployeesFiltersTest extends ApiTestCase
{
    public const URL = '/api/employees';


    public function testEmployeesFiltersDepartment(): void
    {
        $response = static::createClient()->request('GET', self::URL . '?department.name=Продажи');
        $data = $response->toArray();

        $this->assertSame(3, $data[Hydra::TOTAL]);
        $this->assertCount(3, $data[Hydra::MEMBERS]);
    }

    public function testEmployeesFiltersPosition(): void
    {
        $response = static::createClient()->request('GET', self::URL . '?position.name=Руководитель');
        $data = $response->toArray();

        $this->assertSame(4, $data[Hydra::TOTAL]);
        $this->assertCount(4, $data[Hydra::MEMBERS]);
    }

    public function testEmployeesFiltersLastname(): void
    {
        $response = static::createClient()->request('GET', self::URL . '?lastname=ант');
        $data = $response->toArray();

        $this->assertSame(1, $data[Hydra::TOTAL]);
        $this->assertCount(1, $data[Hydra::MEMBERS]);
    }

    public function testEmployeesFiltersBirthDateBefore(): void
    {
        $response = static::createClient()->request(
            'GET',
            self::URL . '?birthDate[before]=1979-01-01');

        $data = $response->toArray();

        $this->assertSame(3, $data[Hydra::TOTAL]);
        $this->assertCount(3, $data[Hydra::MEMBERS]);
    }

    public function testEmployeesFiltersBirthDateBeforeAndAfter(): void
    {
        $response = static::createClient()->request(
            'GET',
            self::URL . '?birthDate[before]=1979-01-01&birthDate[after]=1972-03-01');
        $data = $response->toArray();

        $this->assertSame(1, $data[Hydra::TOTAL]);
        $this->assertCount(1, $data[Hydra::MEMBERS]);
    }
}
