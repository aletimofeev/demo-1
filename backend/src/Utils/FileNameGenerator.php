<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Utils;

class FileNameGenerator
{
    private const HASH_LENGTH = 5;

    public function generate(string $filename, string $ext, string $dir = null): string
    {
        $date = new \DateTime();

        return sprintf(
            '%s%s_%s_%s.%s',
            $dir ? $dir.'/' : '',
            $filename,
            $date->format('Y-m-d'),
            $this->hash(),
            $ext
        );
    }

    private function hash(): string
    {
        return bin2hex(random_bytes(self::HASH_LENGTH));
    }
}
