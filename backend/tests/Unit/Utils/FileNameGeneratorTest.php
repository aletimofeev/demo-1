<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Unit\Utils;

use App\Utils\FileNameGenerator;
use PHPUnit\Framework\TestCase;

class FileNameGeneratorTest extends TestCase
{
    public function testGenerateExtension()
    {
        $generator = new FileNameGenerator();
        $ext = 'ext';

        $filename = $generator->generate('test', $ext);
        $this->assertStringEndsWith($ext, $filename);
    }

    public function testGenerateFilenameAndDate()
    {
        $generator = new FileNameGenerator();
        $ext = 'ext';

        $filename = $generator->generate('test', $ext);
        $date = (new \DateTime())->format('Y-m-d');

        $this->assertStringContainsString('test', $filename);
        $this->assertStringContainsString($date, $filename);
    }

    public function testGenerateStringFormat()
    {
        $generator = new FileNameGenerator();
        $ext = 'ext';

        $filename = $generator->generate('test', $ext);

        $arr = explode('_', $filename);
        $this->assertCount(3, $arr);
    }

    public function testGenerateHashLength()
    {
        $generator = new FileNameGenerator();
        $ext = 'ext';

        $filename = $generator->generate('test', $ext);

        list(, , $suffix) = explode('_', $filename);
        list($hash) = explode('.', $suffix);

        $this->assertSame(10, \mb_strlen($hash));
    }

    public function testGenerateFilenameWithDir()
    {
        $generator = new FileNameGenerator();
        $ext = 'ext';
        $dir = 'my-dir/data';

        $filename = $generator->generate('test', $ext, $dir);
        $date = (new \DateTime())->format('Y-m-d');

        $this->assertStringContainsString('my-dir/data/test', $filename);
        $this->assertStringContainsString($date, $filename);
    }
}
