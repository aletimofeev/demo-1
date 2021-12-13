<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Service\Employee;

use App\Repository\EmployeeRepository;
use App\Service\Employee\EmployeeService;
use App\Service\Employee\SpreadsheetCreator;
use App\Utils\FileNameGenerator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EmployeeServiceTest extends KernelTestCase
{
    public const DATA_DIR = __DIR__.'/../../data';
    public const DATA = [1, 2];

    private array $filenames = [];

    public function testCallRepository()
    {
        $data = require __DIR__.'/../../data/employees.php';

        $creator = $this->createMock(SpreadsheetCreator::class);
        $creator
            ->expects($this->once())
            ->method('create')
            ->with($data)
            ->willReturn(new Spreadsheet());

        $filenameGenerator = $this->createMock(FileNameGenerator::class);
        $filenameGenerator
            ->method('generate')
            ->willReturn(self::DATA_DIR.'/file.xls');

        $repository = $this->createMock(EmployeeRepository::class);
        $repository
            ->method('findBy')
            ->willReturn($data);

        $service = new EmployeeService(
            $creator,
            $filenameGenerator,
            $repository,
            self::DATA_DIR
        );

        $service->createSpreadsheet(self::DATA);
    }

    public function testCreateAndSave(): void
    {
        $creator = $this->createMock(SpreadsheetCreator::class);
        $creator
            ->method('create')
            ->willReturn(new Spreadsheet());

        $filenameGenerator = $this->createMock(FileNameGenerator::class);
        $filenameGenerator
            ->method('generate')
            ->willReturn(self::DATA_DIR.'/file.xls');

        $repository = $this->createMock(EmployeeRepository::class);
        $repository
            ->method('findBy')
            ->willReturn(['one', 'two']);

        $service = new EmployeeService(
            $creator,
            $filenameGenerator,
            $repository,
            self::DATA_DIR
        );

        $filename = $service->createSpreadsheet(self::DATA);
        $this->filenames[] = $filename;

        $this->assertFileExists($filename);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        foreach ($this->filenames as $filename) {
            unlink($filename);
        }
    }
}
