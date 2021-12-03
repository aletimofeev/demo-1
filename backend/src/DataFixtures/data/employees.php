<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$departments = \App\DataFixtures\DepartmentFixtures::NAMES;
$positions = \App\DataFixtures\PositionFixtures::NAMES;

return [
    // 'Продажи'
    // 'Руководитель'
    'Антонов Антон Антонович 1970-01-01 antonov@example.com ' . $departments[0] . ' ' . $positions[0],
    // 'Старший специалист'
    'Борисов Борис Борисович 1972-02-02 borisov@example.com ' . $departments[0] . ' ' . $positions[1],
    // 'Младший специалист'
    'Валерьев Валерий Валерьевич 1973-03-03 valeriev@example.com ' . $departments[0] . ' ' . $positions[2],

    //  'Закупки'
    'Григорьев Григорий Григорьевич 1980-01-01 grigoriev@example.com ' . $departments[1] . ' ' . $positions[0],
    'Данилова Дания Даниловна 1983-03-03 danilova@example.com ' . $departments[1] . ' ' . $positions[1],
    'Ефимов Ефим Ефимович 1984-04-04 efimov@example.com ' . $departments[1] . ' ' . $positions[2],

    // 'IT'
    'Заикина Зайка Зайковна 1990-01-01 zaikina@example.com ' . $departments[2] . ' ' . $positions[0],
    'Иванов Иван Иванович 1994-04-04 ivanov@example.com ' . $departments[2] . ' ' . $positions[1],
    'Катеринова Катерина Каримовна 1996-06-13 katerinova@example.com ' . $departments[2] . ' ' . $positions[2],

    // 'Реклама'
    'Марьина Мария Ивановна 2002-01-01 marina@example.com ' . $departments[3] . ' ' . $positions[0],
    'Николаев Николай Николаевич 2001-01-01 nikolaev@example.com ' . $departments[3] . ' ' . $positions[1],
    'Ольгина Ольга Олеговна 2000-02-02 olgina@example.com ' . $departments[3] . ' ' . $positions[2],
];
