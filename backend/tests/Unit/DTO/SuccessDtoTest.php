<?php

namespace App\Tests\Unit\DTO;

use App\DTO\SuccessDTO;
use PHPUnit\Framework\TestCase;

class SuccessDtoTest extends TestCase
{
    public function testCreateEmpty(): void
    {
        $dto = new SuccessDTO();
        $this->assertSame(['success' => true], $dto->getData());
        $this->assertSame(200, $dto->getCode());
    }

    public function testCreateWithCode(): void
    {
        $dto = new SuccessDTO(201);
        $this->assertSame(['success' => true], $dto->getData());
        $this->assertSame(201, $dto->getCode());
    }
}
