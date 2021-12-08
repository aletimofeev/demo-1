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

class EmployeesTest extends ApiTestCase
{
    use ApiHelperTrait;

    public const URL = '/api/employees';

    public function testEmployeesForbidden(): void
    {
        static::createClient()->request('GET', self::URL);
        $this->assertResponseStatusCodeSame(401);
    }

    public function testEmployeesAsUserSuccess(): void
    {
        $this->requestAsUser(self::URL);
        $this->assertResponseIsSuccessful();
    }

    public function testEmployeesAsEditorSuccess(): void
    {
        $this->requestAsUser(self::URL);
        $this->assertResponseIsSuccessful();
    }

    public function testEmployeesJson(): void
    {
        $this->requestAsUser(self::URL);

        $this->assertJsonContains([
            '@id' => '/api/employees',
            '@type' => 'hydra:Collection',
            'hydra:member' => [],
        ]);
    }

    public function testEmployeesMember(): void
    {
        $response = $this->requestAsEditor(self::URL);
        $data = $response->toArray();
        $member = $data[Hydra::MEMBERS][0];

        $this->assertArrayHasKey('lastname', $member);
        $this->assertArrayHasKey('firstname', $member);
        $this->assertArrayHasKey('patronymic', $member);
        $this->assertArrayHasKey('birthDate', $member);
        $this->assertArrayHasKey('email', $member);
        $this->assertArrayHasKey('department', $member);
        $this->assertArrayHasKey('position', $member);
    }

    public function testEmployeesCount(): void
    {
        $response = $this->requestAsEditor(self::URL);

        $data = $response->toArray();
        $this->assertSame(12, $data[Hydra::TOTAL]);
        $this->assertCount(12, $data[Hydra::MEMBERS]);
    }
}
