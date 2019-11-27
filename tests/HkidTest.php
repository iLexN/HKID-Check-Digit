<?php

namespace Ilex\Validation\HkidValidation\Tests;

use Generator;
use Ilex\Validation\HkidValidation\Helper;
use Ilex\Validation\HkidValidation\HkidDigitCheck;
use Ilex\Validation\HkidValidation\Reason\DigitError;
use Ilex\Validation\HkidValidation\Reason\PattenError;
use Ilex\Validation\HkidValidation\Reason\ReasonInterface;
use PHPUnit\Framework\TestCase;

class HkidTest extends TestCase
{

    /**
     * @dataProvider additionProviderTrueResult
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     * @param string $expectedFormat
     */
    public function testCheckPartsHkidFormatTrue(
        string $p1,
        string $p2,
        string $p3,
        string $expectedFormat
    ): void {
        $a = Helper::checkByParts($p1, $p2, $p3);

        self::assertTrue($a->isValid());
        self::assertEquals(ReasonInterface::OK, $a->getReason());
        self::assertFalse($a->isDigitError());
        self::assertFalse($a->isPattenError());

        self::assertEquals($expectedFormat, $a->format());
        self::assertEquals($expectedFormat, (string)$a);
        self::assertEquals($this->clearString($p1), $a->getPart1());
        self::assertEquals($this->clearString($p2), $a->getPart2());
        self::assertEquals($this->clearString($p3), $a->getPart3());
    }

    /**
     * @dataProvider additionProviderTrueResult
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     * @param string $expectedFormat
     */
    public function testCheckStringHkidFormatHelperTrue(
        string $p1,
        string $p2,
        string $p3,
        string $expectedFormat
    ): void {
        $c = Helper::checkByString($this->partsToString($p1, $p2, $p3));

        self::assertTrue($c->isValid());
        self::assertEquals(ReasonInterface::OK, $c->getReason());
        self::assertFalse($c->isDigitError());
        self::assertFalse($c->isPattenError());

        self::assertEquals($expectedFormat, $c->format());
        self::assertEquals($expectedFormat, (string)$c);
        self::assertEquals($this->clearString($p1), $c->getPart1());
        self::assertEquals($this->clearString($p2), $c->getPart2());
        self::assertEquals($this->clearString($p3), $c->getPart3());
    }

    /**
     * @dataProvider additionProviderTrueResult
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     * @param string $expectedFormat
     */
    public function testCheckHkidFormatMainTrue(
        string $p1,
        string $p2,
        string $p3,
        string $expectedFormat
    ): void {
        $b = new HkidDigitCheck();
        $r = $b->checkParts($p1, $p2, $p3);
        self::assertTrue($r->isValid());
        self::assertEquals(ReasonInterface::OK, $r->getReason());
        self::assertFalse($r->isDigitError());
        self::assertFalse($r->isPattenError());

        self::assertEquals($expectedFormat, $r->format());
        self::assertEquals($expectedFormat, (string)$r);
        self::assertEquals($this->clearString($p1), $r->getPart1());
        self::assertEquals($this->clearString($p2), $r->getPart2());
        self::assertEquals($this->clearString($p3), $r->getPart3());
    }

    public function additionProviderTrueResult(): Generator
    {
        yield 'B111111(1)' .
            '' => ['B', '111111', '1', 'B111111(1)'];
        yield 'CA182361(1)' => ['Ca', '182361', '1', 'CA182361(1)'];
        yield 'ZA182361(3)' => ['zA', '182361', '3', 'ZA182361(3)'];
        yield 'B111112(A)' => ['B', '111112', 'A', 'B111112(A)'];
        yield 'B111117(0)' => ['B', '111117', '0', 'B111117(0)'];
        //test trim
        yield ' B111117(0)' => [' B', '111117', '0', 'B111117(0)'];
        yield 'z109852(8)' => ['z', '109852', '8', 'Z109852(8)'];
    }

    public function additionProviderFalseResult(): Generator
    {

        $p = new PattenError();
        $d = new DigitError();

        yield 'B111111(3)' => ['B', '111111', '3', $d];
        yield 'CAC182361(1)' => ['CaC', '182361', '1', $p];
        yield '111112(A)' => ['', '111112', 'A', $p];
        yield '1B111117(0)' => ['1B', '111117', '0', $p];
        yield '1111117(0)' => ['1', '111117', '0', $p];
        yield '122(0)' => ['B', '22', '0', $p];
        yield 'B111111(G)' => ['B', '111111', 'G', $d];
        //wrong format
        yield '1111a' => ['1', '111a', '11', $p];
        yield '11111a1' => ['1', '111a11', '11', $p];
    }

    /**
     * @dataProvider additionProviderFalseResult
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     * @param \Ilex\Validation\HkidValidation\Reason\ReasonInterface $reason
     */
    public function testCheckHkidFormatFalse(
        string $p1,
        string $p2,
        string $p3,
        ReasonInterface $reason
    ): void {
        $a = Helper::checkByParts($p1, $p2, $p3);
        self::assertFalse($a->isValid());
        self::assertEquals($reason->getKey(), $a->getReason());
        self::assertEquals($reason->isDigitError(),$a->isDigitError());
        self::assertEquals($reason->isPattenError(),$a->isPattenError());

        $a = Helper::checkByString($this->partsToString($p1, $p2, $p3));
        self::assertFalse($a->isValid());
        self::assertEquals($reason->getKey(), $a->getReason());
        self::assertEquals($reason->isDigitError(),$a->isDigitError());
        self::assertEquals($reason->isPattenError(),$a->isPattenError());
    }

    /**
     * @param string $p1
     * @param string $p2
     * @param string $p3
     *
     * @return string
     *
     * @see \Ilex\Validation\HkidValidation\HkIdValidResult::format
     */
    private function partsToString(string $p1, string $p2, string $p3): string
    {
        return $p1 . $p2 . '(' . $p3 . ')';
    }

    /**
     * @param string $string
     *
     * @return string
     *
     * @see \Ilex\Validation\HkidValidation\HkidDigitCheck::clearString
     */
    private function clearString(string $string): string
    {
        return strtoupper(trim($string));
    }
}
