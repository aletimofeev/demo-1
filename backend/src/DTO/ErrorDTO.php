<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DTO;

use Symfony\Component\HttpFoundation\Response;

class ErrorDTO extends ResponseDTO
{
    public function __construct(
        string $message,
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR
    ) {
        parent::__construct(['error' => $message], $statusCode);
    }
}
