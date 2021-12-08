<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Service\Employee;

use App\Repository\EmployeeRepository;
use App\Utils\FileNameGenerator;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class EmployeeService
{
    private SpreadsheetCreator $spreadsheetCreator;
    private FileNameGenerator $fileNameGenerator;
    private EmployeeRepository $employeeRepository;
    private string $dataDir;

    /**
     * @param \App\Service\Employee\SpreadsheetCreator $spreadsheetCreator
     * @param $dataDir
     */
    public function __construct(
        SpreadsheetCreator $spreadsheetCreator,
        FileNameGenerator $fileNameGenerator,
        EmployeeRepository $employeeRepository,
                           $dataDir
    ) {
        $this->spreadsheetCreator = $spreadsheetCreator;
        $this->fileNameGenerator = $fileNameGenerator;
        $this->employeeRepository = $employeeRepository;
        $this->dataDir = $dataDir;
    }

    public function createSpreadsheet(array $ids): string
    {
        $data = $this->employeeRepository->findBy(['id' => $ids]);
        $sheet = $this->spreadsheetCreator->create($data);

        $writer = new Xls($sheet);
        $filename = $this->fileNameGenerator->generate('employees', 'xls', $this->dataDir);
        $writer->save($filename);

        return $filename;
    }
}
