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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SpreadsheetCreator
{
    public const COLS = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];

    /**
     * Создает лист excel с данными работника.
     *
     * @param \App\Entity\Employee[] $data
     */
    public function create(array $data): Spreadsheet
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $this->getSheetTitle($sheet);

        $row = 2;
        $counter = 1;
        foreach ($data as $employee) {
            $values = [
                $counter++,
                $employee->getLastname(),
                $employee->getFirstname(),
                $employee->getPatronymic(),
                $employee->getBirthDate()->format('d.m.Y'),
                $employee->getEmail(),
                $employee->getDepartment()->getName(),
                $employee->getPosition()->getName(),
            ];

            $this->setValues($sheet, $values, $row++);
        }

        return $spreadsheet;
    }

    private function getSheetTitle(Worksheet $sheet): void
    {
        $strRange = sprintf(
            '%s%d:%s%d',
            self::COLS[0],
            1,
            self::COLS[array_key_last(self::COLS)],
            1
        );

        foreach (self::COLS as $coll) {
            $sheet->getColumnDimension($coll)->setAutoSize(true);
        }

        $sheet->getStyle($strRange)->getFont()->setBold(true);

        $this->setValues(
            $sheet,
            [
                '№', 'Фамилия', 'Имя', 'Отчество', 'Дата рождения', 'Почта', 'Отдел', 'Должность',
            ],
            1
        );
    }

    private function setValues(Worksheet &$sheet, array $values, int $row): void
    {
        foreach (self::COLS as $index => $col) {
            $sheet->setCellValue($col.$row, $values[$index]);
        }
    }
}
