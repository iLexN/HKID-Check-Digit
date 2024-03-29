<?php

namespace Ilex\Validation\HkidValidation\Tests;

use Generator;
use Ilex\Validation\HkidValidation\Enum\Reason;
use Ilex\Validation\HkidValidation\Helper;
use Ilex\Validation\HkidValidation\HkidDigitCheck;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class HkidTest extends TestCase
{

    /**
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     * @throws \Ilex\ResultOption\Error\OptionException
     */
    #[DataProvider('additionProviderTrueResult')]
    public function testCheckPartsHkidFormatTrue(
        string $p1,
        string $p2,
        string $p3,
        string $expectedFormat
    ): void {
        $a = Helper::checkByParts($p1, $p2, $p3);

        $this->assertTrue($a->isValid());
        $this->assertEquals(Reason::Ok, $a->getReason());
        $this->assertFalse($a->isDigitError());
        $this->assertFalse($a->isPattenError());

        $this->assertSame($expectedFormat, $a->format());
        $this->assertSame($expectedFormat, (string)$a);
        $this->assertSame($this->clearString($p1), $a->getPart1());
        $this->assertSame($this->clearString($p2), $a->getPart2());
        $this->assertSame($this->clearString($p3), $a->getPart3());
    }

    /**
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     * @throws \Ilex\ResultOption\Error\OptionException
     */
    #[DataProvider('additionProviderTrueResult')]
    public function testCheckStringHkidFormatHelperTrue(
        string $p1,
        string $p2,
        string $p3,
        string $expectedFormat
    ): void {
        $c = Helper::checkByString($this->partsToString($p1, $p2, $p3));

        $this->assertTrue($c->isValid());
        $this->assertEquals(Reason::Ok, $c->getReason());
        $this->assertFalse($c->isDigitError());
        $this->assertFalse($c->isPattenError());

        $this->assertSame($expectedFormat, $c->format());
        $this->assertSame($expectedFormat, (string)$c);
        $this->assertSame($this->clearString($p1), $c->getPart1());
        $this->assertSame($this->clearString($p2), $c->getPart2());
        $this->assertSame($this->clearString($p3), $c->getPart3());
    }

    /**
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     * @throws \Ilex\ResultOption\Error\OptionException
     */
    #[DataProvider('additionProviderTrueResult')]
    public function testCheckHkidFormatMainTrue(
        string $p1,
        string $p2,
        string $p3,
        string $expectedFormat
    ): void {
        $b = new HkidDigitCheck();
        $r = $b->checkParts($p1, $p2, $p3);
        $this->assertTrue($r->isValid());
        $this->assertEquals(Reason::Ok, $r->getReason());
        $this->assertFalse($r->isDigitError());
        $this->assertFalse($r->isPattenError());

        $this->assertSame($expectedFormat, $r->format());
        $this->assertSame($expectedFormat, (string)$r);
        $this->assertSame($this->clearString($p1), $r->getPart1());
        $this->assertSame($this->clearString($p2), $r->getPart2());
        $this->assertSame($this->clearString($p3), $r->getPart3());
    }

    /**
     * @return \Generator<array<int,string>>
     */
    public static function additionProviderTrueResult(): Generator
    {
        yield 'B111111(1)' => ['B', '111111', '1', 'B111111(1)'];
        yield 'CA182361(1)' => ['Ca', '182361', '1', 'CA182361(1)'];
        yield 'ZA182361(3)' => ['zA', '182361', '3', 'ZA182361(3)'];
        yield 'B111112(A)' => ['B', '111112', 'A', 'B111112(A)'];
        yield 'B111117(0)' => ['B', '111117', '0', 'B111117(0)'];
        //test trim
        yield ' B111117(0)' => [' B', '111117', '0', 'B111117(0)'];
        yield 'z109852(8)' => ['z', '109852', '8', 'Z109852(8)'];
    }

    /**
     * @return \Generator<array<int,string|Reason>>
     */
    public static function additionProviderFalseResult(): Generator
    {
        $p = Reason::PattenError;
        $d = Reason::DigitError;

        yield 'B111111(3)' => ['B', '111111', '3', $d, 'B111111(3)'];
        yield 'CAC182361(1)' => ['CaC', '182361', '1', $p, 'CAC182361(1)'];
        yield '111112(A)' => ['', '111112', 'A', $p, '111112(A)'];
        yield '1B111117(0)' => ['1B', '111117', '0', $p, '1B111117(0)'];
        yield '1111117(0)' => ['1', '111117', '0', $p, '1111117(0)'];
        yield 'B22(0)' => ['B', '22', '0', $p, 'B22(0)'];
        yield 'B111111(G)' => ['B', '111111', 'G', $d, 'B111111(G)'];
        //wrong format
        yield '1111a(11)' => ['1', '111a', '11', $p, '1111a(11)'];
        yield '1111a11(11)' => ['1', '111a11', '11', $p, '1111a11(11)'];
    }

    /**
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     */
    #[DataProvider('additionProviderFalseResult')]
    public function testCheckHkidFormatFalse(
        string $p1,
        string $p2,
        string $p3,
        Reason $reason,
    ): void {
        $a = Helper::checkByParts($p1, $p2, $p3);
        $this->assertFalse($a->isValid());
        $this->assertEquals($reason, $a->getReason());
        $this->assertEquals($reason->isDigitError(), $a->isDigitError());
        $this->assertEquals($reason->isPattenError(), $a->isPattenError());

        switch ($reason) {
            case Reason::DigitError:
                $this->assertFalse($a->isPattenError());
                $this->assertTrue($a->isDigitError());
                break;
            case Reason::PattenError:
                $this->assertTrue($a->isPattenError());
                $this->assertFalse($a->isDigitError());
                break;
        }

        $a = Helper::checkByString($this->partsToString($p1, $p2, $p3));
        $this->assertFalse($a->isValid());
        $this->assertEquals($reason, $a->getReason());
        $this->assertEquals($reason->isDigitError(), $a->isDigitError());
        $this->assertEquals($reason->isPattenError(), $a->isPattenError());
    }

    public function testSameInstance(): void
    {
        $one = Helper::factory();
        $two = Helper::factory();
        $this->assertSame($one, $two);
        $this->assertEquals($one, $two);
    }

    /**
     * @see \Ilex\Validation\HkidValidation\HkIdValidResult::format
     */
    private function partsToString(string $p1, string $p2, string $p3): string
    {
        return $p1 . $p2 . '(' . $p3 . ')';
    }

    /**
     *
     * @see \Ilex\Validation\HkidValidation\HkidDigitCheck::clearString
     */
    private function clearString(string $string): string
    {
        return strtoupper(trim($string));
    }
}
