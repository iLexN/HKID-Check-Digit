<?php

namespace Ilex\Test;

class HkidTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testCheckHKIDFormat($p1, $p2, $p3)
    {
        $a = \Ilex\Validation\HkidCheckDigit::checkHKIDFormat($p1, $p2, $p3);
        $this->assertTrue($a);

        $b = new \Ilex\Validation\HkidCheckDigit($p1, $p2, $p3);
        $this->assertTrue($b->checkHKID());
    }

    public function additionProvider()
    {
        return [
            'B111111(1)'  => ['B', '111111', '1'],
            'CA182361(1)' => ['CA', '182361', '1'],
            //'ZA182361(3)' => array('ZA', '182361', '3'),
            'B111112(A)' => ['B', '111112', 'A'],
            'B111117(0)' => ['B', '111117', '0'],
        ];
    }

    public function testCheckHKIDFormatFalse()
    {
        $p1 = 'B';
        $p2 = '111111';
        $p3 = '3';

        $a = \Ilex\Validation\HkidCheckDigit::checkHKIDFormat($p1, $p2, $p3);
        $this->assertFalse($a);

        $b = new \Ilex\Validation\HkidCheckDigit($p1, $p2, $p3);
        $this->assertFalse($b->checkHKID());
    }

    public function testCheckHKIDFormatFalse2()
    {
        $p1 = 'BSA';
        $p2 = '111111';
        $p3 = '3';

        $a = \Ilex\Validation\HkidCheckDigit::checkHKIDFormat($p1, $p2, $p3);
        $this->assertFalse($a);

        $b = new \Ilex\Validation\HkidCheckDigit($p1, $p2, $p3);
        $this->assertFalse($b->checkHKID());
    }
}