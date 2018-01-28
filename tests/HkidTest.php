<?php

namespace Ilex\Validation\HkidValidation\Tests;

use Ilex\Validation\HkidValidation\Helper;
use Ilex\Validation\HkidValidation\HkidDigitCheck;
use PHPUnit\Framework\TestCase;

class HkidTest extends TestCase
{
    /**
     * @dataProvider additionProviderTrueResult
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     */
    public function testCheckHKIDFormat(string $p1, string $p2, string $p3)
    {
        $a = Helper::checkByParts($p1, $p2, $p3);
        $this->assertTrue($a);
    }

    /**
     * @dataProvider additionProviderTrueResult
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     */
    public function testCheckHKIDFormat2(string $p1, string $p2, string $p3)
    {
        $c = Helper::checkByString($this->partsToString($p1, $p2, $p3));
        $this->assertTrue($c);
    }

    /**
     * @dataProvider additionProviderTrueResult
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     */
    public function testCheckHKIDFormat3(string $p1, string $p2, string $p3)
    {
        $b = new HkidDigitCheck();
        $this->assertTrue($b->checkParts($p1, $p2, $p3));
    }

    private function partsToString($p1, $p2, $p3)
    {
        return $p1.$p2.'('.$p3.')';
    }

    public function additionProviderTrueResult()
    {
        return [
            'B111111(1)'  => ['B', '111111', '1'],
            'CA182361(1)' => ['Ca', '182361', '1'],
            'ZA182361(3)' => ['zA', '182361', '3'],
            'B111112(A)' => ['B', '111112', 'A'],
            'B111117(0)' => ['B', '111117', '0'],
        ];
    }

    public function additionProviderFalseResult()
    {
        return [
            'B111111(3)'  => ['B', '111111', '3'],
            'CAC182361(1)' => ['CaC', '182361', '1'],
            '111112(A)' => ['', '111112', 'A'],
            '1B111117(0)' => ['1B', '111117', '0'],
            '1111117(0)' => ['1', '111117', '0'],
            '122(0)' => ['B', '22', '0'],
            'B111111(G)'  => ['B', '111111', 'G'],
        ];
    }

    /**
     * @dataProvider additionProviderFalseResult
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     */
    public function testCheckHKIDFormatFalse(string $p1, string $p2, string $p3)
    {
        $a = Helper::checkByParts($p1, $p2, $p3);
        $this->assertFalse($a);

        $c = Helper::checkByString($this->partsToString($p1, $p2, $p3));
        $this->assertFalse($c);

        $b = new HkidDigitCheck();
        $this->assertFalse($b->checkParts($p1, $p2, $p3));
    }
}
