<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation;

use Ilex\Validation\HkidValidation\Reason\DigitError;
use Ilex\Validation\HkidValidation\Reason\Ok;
use Ilex\Validation\HkidValidation\Reason\PattenError;

/**
 * Class HkidDigitCheck
 *
 * @package Ilex\Validation\HkidValidation
 */
final class HkidDigitCheck
{
    private const ONE_CHAT_NUM = 324;

    private const MOD_NUM = 11;
    private const MOD_NUM_10 = 'A';
    private const MOD_NUM_11 = 0;
    private const MOD_MATCH_10 = 10;
    private const MOD_MATCH_11 = 11;

    private const CHAT_WEIGHT_1 = 9;
    private const CHAT_WEIGHT_2 = 8;

    private const NUM_WEIGHT_1 = 7;
    private const NUM_WEIGHT_2 = 6;
    private const NUM_WEIGHT_3 = 5;
    private const NUM_WEIGHT_4 = 4;
    private const NUM_WEIGHT_5 = 3;
    private const NUM_WEIGHT_6 = 2;

    private const CHAT_CONVERT_START_NUM = 10;


    /**
     * variable for cal for part1
     *
     * @var int[]
     */
    private array $partOneCharNumArray;

    /**
     * HkidDigitCheck constructor.
     */
    public function __construct()
    {
        $this->partOneCharNumArray = $this->getCharNumValue();
    }

    /**
     * upper case and trim space
     *
     * @param string $string
     *
     * @return string
     */
    private function clearString(string $string): string
    {
        return strtoupper(trim($string));
    }

    /**
     * check by part
     *
     * @param string $p1
     * @param string $p2
     * @param string $p3
     *
     * @return HkIdValidResult
     */
    public function checkParts(
        string $p1,
        string $p2,
        string $p3
    ): HkIdValidResult {
        $hkid = new Hkid($this->clearString($p1), $p2, $this->clearString($p3));

        return $this->checkString($hkid->format());
    }

    /**
     * check whole string format and pattern
     *
     * @param string $string
     *
     * @return HkIdValidResult
     */
    public function checkString(string $string): HkIdValidResult
    {
        try {
            $hkid = $this->validate($string);
            $valid = $this->isValid($hkid);
            $reason = $valid ? new Ok() : new DigitError();
            return new HkIdValidResult($hkid, $reason);
        } catch (HkidInvalidException $exception) {
            return new HkIdValidResult(new Hkid('', '', ''), new PattenError());
        }
    }

    private function isValid(Hkid $hkid): bool
    {
        return $this->getPart2Remainder(
                $hkid->getPart2(),
                $this->getCharSum($hkid->getPart1())
            ) === $hkid->getPart3();
    }

    /**
     * break down the string to part1,2,3
     *
     * @param string $string
     *
     * @return \Ilex\Validation\HkidValidation\Hkid
     * @throws \Ilex\Validation\HkidValidation\HkidInvalidException wrong format
     */
    private function validate(string $string): Hkid
    {
        $re = '/^(?P<p1>\D{1,2})(?P<p2>\d{6})\((?P<p3>[\w{1}0-9aA])\)$/i';
        if (1 === preg_match($re, $string, $matches)) {
            return new Hkid(
                $this->clearString($matches['p1']),
                $matches['p2'],
                $this->clearString($matches['p3'])
            );
        }

        throw HkidInvalidException::create($string);
    }

    /**
     * get part 1 num sum
     *
     * @param string $p1
     *
     * @return int
     */
    private function getCharSum(string $p1): int
    {
        $countChat = \strlen($p1);
        if ($countChat === 1) {
            return self::ONE_CHAT_NUM + $this->partOneCharNumArray[$p1] * self::CHAT_WEIGHT_2;
        }
        //$countChat === 2
        return $this->partOneCharNumArray[$p1[0]] * self::CHAT_WEIGHT_1 + $this->partOneCharNumArray[$p1[1]] * self::CHAT_WEIGHT_2;
    }

    /**
     * Get part 2 remainder
     *
     * @param string $p2
     * @param int $charSum
     *
     * @return string
     */
    private function getPart2Remainder(string $p2, int $charSum): string
    {
        $hkidSum = $this->calPart2Remainder($p2, $charSum);

        switch ($hkidSum) {
            case self::MOD_MATCH_11:
                $hkidSum = self::MOD_NUM_11;
                break;
            case self::MOD_MATCH_10:
                $hkidSum = self::MOD_NUM_10;
                break;
        }

        return (string)$hkidSum;
    }

    /**
     * Cal Part 2 Remainder
     *
     * @param string $part2
     * @param int $charSum
     *
     * @return int
     */
    private function calPart2Remainder(string $part2, int $charSum): int
    {
        $p2 = array_map(fn ($int): int => (int)$int, \str_split($part2));

        return self::MOD_NUM - ((
            $charSum +
            $p2[0] * self::NUM_WEIGHT_1 +
            $p2[1] * self::NUM_WEIGHT_2 +
            $p2[2] * self::NUM_WEIGHT_3 +
            $p2[3] * self::NUM_WEIGHT_4 +
            $p2[4] * self::NUM_WEIGHT_5 +
            $p2[5] * self::NUM_WEIGHT_6
        ) % self::MOD_NUM);
    }

    /**
     * set up variable for cal for part1
     *
     * @return int[]
     */
    private function getCharNumValue(): array
    {
        $i = self::CHAT_CONVERT_START_NUM;
        $idCheckArray = [];
        foreach (range('A', 'Z') as $char) {
            $idCheckArray[$char] = $i++;
        }

        return $idCheckArray;
    }
}
