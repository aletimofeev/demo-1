<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmployeeControllerTest extends WebTestCase
{
    /**
     * @ski
     */
    public function testSomething(): void
    {
        $this->markTestIncomplete('В разработке');
        $response = static::createClient()->request('GET', '/employees');

        $this->assertResponseIsSuccessful();
        $this->assertJson();
    }
}
