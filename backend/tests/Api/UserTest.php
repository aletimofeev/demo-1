<?php

namespace App\Tests\Api;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class UserTest extends ApiTestCase
{
    use ApiHelperTrait;

    public function testLogin(): void
    {
        $client = static::createClient();
        $response = $client->request('POST', '/api/login', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'email' => 'user@example.com',
                'password' => 'user@example.com',
            ],
        ]);

        $json = $response->toArray();

        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('token', $json);
    }

    public function testGetMeForbidden(): void
    {
        static::createClient()->request('GET', '/api/get-me');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testGetMe(): void
    {
        $response = $this->requestAsUser('/api/get-me');

        list($lastname, $firstname, $roles) = array_values($response->toArray());

        $this->assertSame($lastname, 'Андреев');
        $this->assertSame($firstname, 'Андрей');
        $this->assertSame($roles, ['ROLE_USER']);
    }
}
