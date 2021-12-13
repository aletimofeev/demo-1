<?php

/*
 * (c) Alexandr Timofeev <tim31al@gmail.com>
 */

namespace App\Tests\Unit\Message;

use App\Message\EmployeeSpreadsheetMessage;
use PHPUnit\Framework\TestCase;

class EmployeeSpreadsheetMessageTest extends TestCase
{
    public function testCreateMessage(): void
    {
        $message = new EmployeeSpreadsheetMessage([1], 'test@example.com', 'test');
        $this->assertInstanceOf(EmployeeSpreadsheetMessage::class, $message);
    }

    public function testGetContext(): void
    {
        $message = new EmployeeSpreadsheetMessage([1], 'test@example.com', 'test');
        $context = $message->getContext();

        $this->assertSame(
            [
                'ids' => [1],
                'email' => 'test@example.com',
                'username' => 'test',
            ],
            $context
        );
    }
}
