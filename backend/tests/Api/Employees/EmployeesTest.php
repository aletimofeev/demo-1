<?php

namespace App\Tests\Api\Employees;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\Api\Hydra;

class EmployeesTest extends ApiTestCase
{
    public const URL = '/api/employees';

    public function testEmployeesSuccess(): void
    {
        static::createClient()->request('GET', self::URL);

        $this->assertResponseIsSuccessful();
    }

    public function testEmployeesJson(): void
    {
        static::createClient()->request('GET', self::URL);

        $this->assertJsonContains([
            '@id' => '/api/employees',
            '@type' => 'hydra:Collection',
            'hydra:member' => []
        ]);
    }

    public function testEmployeesMember(): void
    {
        $response = static::createClient()->request('GET', self::URL);
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
        $response = static::createClient()->request('GET', self::URL, [
//            'headers' => [
//                'Accept' => 'application/json"',
//            ],
        ]);
//
//        $contentType = $response->getHeaders()['content-type'][0];
//        echo $contentType, \PHP_EOL;

        $data = $response->toArray();
        $this->assertSame(12, $data[Hydra::TOTAL]);
        $this->assertCount(12, $data[Hydra::MEMBERS]);
    }
}
