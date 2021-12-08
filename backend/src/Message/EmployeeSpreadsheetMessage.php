<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Message;

final class EmployeeSpreadsheetMessage
{
    private string $context;

    public function __construct(array $ids, string $email)
    {
        $context = [
            'ids' => $ids,
            'email' => $email,
        ];
        $this->context = json_encode($context);
    }

    public function getContext(): array
    {
        return json_decode($this->context, true);
    }
}
