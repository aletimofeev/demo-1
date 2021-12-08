<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Unit\Service;

use App\Entity\Employee;
use App\Service\Employee\SpreadsheetCreator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PHPUnit\Framework\TestCase;

class SpreadsheetCreatorTest extends TestCase
{
    private array $employees;

    protected function setUp(): void
    {
        parent::setUp();
        $this->employees = require __DIR__.'/../../data/employees.php';
    }

    public function testInstance(): void
    {
        $sheetCreator = new SpreadsheetCreator();
        $this->assertInstanceOf(SpreadsheetCreator::class, $sheetCreator);
    }

    public function testCreate(): void
    {
        $sheetCreator = new SpreadsheetCreator();
        $sheet = $sheetCreator->create($this->employees);

        $this->assertInstanceOf(Spreadsheet::class, $sheet);
    }

    public function testTitles(): void
    {
        $sheetCreator = new SpreadsheetCreator();
        $sheet = $sheetCreator->create($this->employees);

        foreach (SpreadsheetCreator::COLS as $coll) {
            $isBold = $sheet->getActiveSheet()->getCell($coll.'1')->getStyle()->getFont()->getBold();
            $this->assertTrue($isBold);
        }
    }

    public function testEmployee1(): void
    {
        $sheetCreator = new SpreadsheetCreator();
        $sheet = $sheetCreator->create($this->employees)->getActiveSheet();

        /** @var Employee $employee */
        list($employee) = $this->employees;

        $this->assertSame(1, $sheet->getCell('A2')->getValue());
        $this->assertSame($employee->getLastname(), $sheet->getCell('B2')->getValue());
        $this->assertSame($employee->getFirstname(), $sheet->getCell('C2')->getValue());
        $this->assertSame($employee->getPatronymic(), $sheet->getCell('D2')->getValue());
        $this->assertSame($employee->getBirthDate()->format('d.m.Y'), $sheet->getCell('E2')->getValue());
        $this->assertSame($employee->getEmail(), $sheet->getCell('F2')->getValue());
        $this->assertSame($employee->getDepartment()->getName(), $sheet->getCell('G2')->getValue());
        $this->assertSame($employee->getPosition()->getName(), $sheet->getCell('H2')->getValue());
    }

    public function testEmployee2(): void
    {
        $sheetCreator = new SpreadsheetCreator();
        $sheet = $sheetCreator->create($this->employees)->getActiveSheet();

        /** @var Employee $employee */
        list(, $employee) = $this->employees;

        $this->assertSame(2, $sheet->getCell('A3')->getValue());
        $this->assertSame($employee->getLastname(), $sheet->getCell('B3')->getValue());
        $this->assertSame($employee->getFirstname(), $sheet->getCell('C3')->getValue());
        $this->assertSame($employee->getPatronymic(), $sheet->getCell('D3')->getValue());
        $this->assertSame($employee->getBirthDate()->format('d.m.Y'), $sheet->getCell('E3')->getValue());
        $this->assertSame($employee->getEmail(), $sheet->getCell('F3')->getValue());
        $this->assertSame($employee->getDepartment()->getName(), $sheet->getCell('G3')->getValue());
        $this->assertSame($employee->getPosition()->getName(), $sheet->getCell('H3')->getValue());
    }
}
