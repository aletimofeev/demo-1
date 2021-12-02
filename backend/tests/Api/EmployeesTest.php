<?php

namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class EmployeesTest extends ApiTestCase
{
    public function testSomething(): void
    {
        static::createClient()->request('GET', '/api/employees', [
//            'headers' => [
//                'Content-Type' => 'application/json'
//            ]
        ]);

        $this->assertResponseIsSuccessful();
//        $this->assertJsonContains(['@id' => '/']);
    }
}
