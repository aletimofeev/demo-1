<?php

namespace App\Tests\Unit\DTO;

use App\DTO\ErrorDTO;
use PHPUnit\Framework\TestCase;

class ErrorDTOTest extends TestCase
{
    public function testCreate(): void
    {
        $dto = new ErrorDTO('new error');
        $this->assertSame(['error' => 'new error'], $dto->getData());
        $this->assertSame(500, $dto->getCode());
    }

    public function testCreateWithCode(): void
    {
        $dto = new ErrorDTO('not found', 404);
        $this->assertSame(['error' => 'not found'], $dto->getData());
        $this->assertSame(404, $dto->getCode());
    }
}
