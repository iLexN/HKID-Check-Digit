<?php

namespace Ilex\Validation\Test;

use Ilex\Validation\HkidCheckDigit;
use PHPUnit\Framework\TestCase;

class HkidTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     */
    public function testCheckHKIDFormat(string $p1, string $p2, string $p3)
    {
        $a = HkidCheckDigit::createFromParts($p1, $p2, $p3);
        $this->assertTrue($a);

        $b = new HkidCheckDigit();
        $this->assertTrue($b->check($p1, $p2, $p3));
    }

    public function additionProvider()
    {
        return [
            'B111111(1)'  => ['B', '111111', '1'],
            'CA182361(1)' => ['Ca', '182361', '1'],
            'ZA182361(3)' => ['zA', '182361', '3'],
            'B111112(A)' => ['B', '111112', 'A'],
            'B111117(0)' => ['B', '111117', '0'],
        ];
    }

    public function testCheckHKIDFormatFalse()
    {
        $p1 = 'B';
        $p2 = '111111';
        $p3 = '3';

        $a = HkidCheckDigit::createFromParts($p1, $p2, $p3);
        $this->assertFalse($a);

        $b = new HkidCheckDigit();
        $this->assertFalse($b->check($p1, $p2, $p3));
    }

    public function testCheckHKIDFormatFalse2()
    {
        $p1 = 'BSA';
        $p2 = '111111';
        $p3 = '3';

        $a = HkidCheckDigit::createFromParts($p1, $p2, $p3);
        $this->assertFalse($a);

        $b = new HkidCheckDigit();
        $this->assertFalse($b->check($p1, $p2, $p3));
    }
}
