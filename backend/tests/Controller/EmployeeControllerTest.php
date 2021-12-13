<?php

/*
 * (c) Alexandr Timofeev <tim31al@gmail.com>
 */

namespace App\Tests\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Repository\EmployeeRepository;
use App\Tests\Api\ApiHelperTrait;

class EmployeeControllerTest extends ApiTestCase
{
    use ApiHelperTrait;
    public const URL = '/api/employees/email-employees';

    public function testForbidden(): void
    {
        $data = ['ids' => [1, 2]];
        static::createClient()->request('POST', self::URL, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => $data,
        ]);
        $this->assertResponseStatusCodeSame(401);
    }

    public function testGoodData(): void
    {
        /** @var EmployeeRepository $repo */
        $repo = static::getContainer()
            ->get(EmployeeRepository::class);

        $employees = $repo->findBy([], [], 3);
        $ids = array_map(fn ($emp) => $emp->getId(), $employees);
        $data = ['ids' => $ids];

        $this->requestAsUser(self::URL, 'POST', $data);
        $this->assertResponseIsSuccessful();
    }

    public function testBadData(): void
    {
        $this->requestAsUser(self::URL, 'POST', ['data' => 1]);
        $this->assertResponseStatusCodeSame(400, 'ids required');
    }

    public function testBadDataNotArray(): void
    {
        $this->requestAsUser(self::URL, 'POST', ['ids' => 1]);
        $this->assertResponseStatusCodeSame(400, 'ids required');
    }
}
