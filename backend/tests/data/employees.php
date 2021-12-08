<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use App\Entity\Department;
use App\Entity\Employee;
use App\Entity\Position;

$department1 = new Department();
$department1->setName('Отдел 1');
$position1 = new Position();
$position1->setName('Должность 1');

$employee1 = new Employee();
$employee1
    ->setId(1)
    ->setLastname('Антонов')
    ->setFirstname('Антон')
    ->setPatronymic('Антонович')
    ->setBirthDate(new \DateTime('1990-01-01'))
    ->setEmail('antonov@example.com')
    ->setDepartment($department1)
    ->setPosition($position1);

$department2 = new Department();
$department2->setName('Отдел');
$position2 = new Position();
$position2->setName('Должность');

$employee2 = new Employee();
$employee2
    ->setId(2)
    ->setLastname('Иванов')
    ->setFirstname('Иван')
    ->setPatronymic('Иванович')
    ->setBirthDate(new \DateTime('2020-10-10'))
    ->setEmail('ivanow@example.com')
    ->setDepartment($department2)
    ->setPosition($position2);

return [$employee1, $employee2];
