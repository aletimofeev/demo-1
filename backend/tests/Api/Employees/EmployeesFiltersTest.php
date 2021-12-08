<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Api\Employees;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\Api\ApiHelperTrait;
use App\Tests\Api\Hydra;

class EmployeesFiltersTest extends ApiTestCase
{
    use ApiHelperTrait;

    public const URL = '/api/employees';

    public function testEmployeesFiltersDepartment(): void
    {
        $response = $this->requestAsUser(self::URL.'?department.name=Продажи');
        $data = $response->toArray();

        $this->assertSame(3, $data[Hydra::TOTAL]);
        $this->assertCount(3, $data[Hydra::MEMBERS]);
    }

    public function testEmployeesFiltersPosition(): void
    {
        $response = $this->requestAsEditor(self::URL.'?position.name=Руководитель');
        $data = $response->toArray();

        $this->assertSame(4, $data[Hydra::TOTAL]);
        $this->assertCount(4, $data[Hydra::MEMBERS]);
    }

    public function testEmployeesFiltersLastname(): void
    {
        $response = $this->requestAsUser(self::URL.'?lastname=ант');
        $data = $response->toArray();

        $this->assertSame(1, $data[Hydra::TOTAL]);
        $this->assertCount(1, $data[Hydra::MEMBERS]);
    }

    public function testEmployeesFiltersBirthDateBefore(): void
    {
        $response = $this->requestAsEditor(self::URL.'?birthDate[before]=1979-01-01');

        $data = $response->toArray();

        $this->assertSame(3, $data[Hydra::TOTAL]);
        $this->assertCount(3, $data[Hydra::MEMBERS]);
    }

    public function testEmployeesFiltersBirthDateBeforeAndAfter(): void
    {
        $response = $this->requestAsUser(self::URL.'?birthDate[before]=1979-01-01&birthDate[after]=1972-03-01');
        $data = $response->toArray();

        $this->assertSame(1, $data[Hydra::TOTAL]);
        $this->assertCount(1, $data[Hydra::MEMBERS]);
    }
}
