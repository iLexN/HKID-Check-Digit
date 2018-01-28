<?php
declare(strict_types=1);

namespace Ilex\Validation\HkidValidation;

/**
 * Class HkidDigitCheck
 *
 * @package Ilex\Validation\HkidValidation
 */
class HkidDigitCheck
{

    /**
     * variable for cal for part1
     *
     * @var array
     */
    private $partOneCharNumArray = [];

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
     * @return bool
     */
    public function checkParts(string $p1, string $p2, string $p3): bool
    {
        return $this->checkString($this->formatString(
            $this->clearString($p1),
            $p2,
            $this->clearString($p3)
        ));
    }

    /**
     * check whole string format and pattern
     *
     * @param string $string
     *
     * @return bool
     */
    public function checkString(string $string):bool
    {
        try {
            [$p1, $p2, $p3] = $this->validate($string);
            return $this->getPart2Remainder($p2, $this->getCharSum($p1)) === $p3;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * Format String from part1,2,3
     *
     * @param string $p1
     * @param string $p2
     * @param string $p3
     *
     * @return string
     */
    private function formatString(string $p1, string $p2, string $p3): string
    {
        return $p1.$p2.'('.$p3.')';
    }

    /**
     * break down the strong to part1,2,3
     *
     * @param string $string
     *
     * @return array   [part1, part2, part3]
     * @throws \Exception wrong format
     */
    public function validate(string $string): array
    {
        $re = '/^(?P<p1>\D{1,2})(?P<p2>\d{6})\((?P<p3>[\w{1}0-9aA])\)$/i';
        if (0 === preg_match($re, $string, $matches)) {
            throw new \Exception('Validate fail');
        }

        return [
            $this->clearString($matches['p1']),
            $matches['p2'],
            $this->clearString($matches['p3']),
        ];
    }

    /**
     * get part 1 num sum
     *
     * @param string $p1
     *
     * @return int
     * @throws \Exception
     */
    private function getCharSum(string $p1): int
    {
        $countChat = strlen($p1);
        if ($countChat === 1) {
            return 324 + $this->partOneCharNumArray[$p1[0]] * 8;
        }
        //$countChat === 2
        return $this->partOneCharNumArray[$p1[0]] * 9 + $this->partOneCharNumArray[$p1[1]] * 8;
    }

    /**
     * Get part 2 remainder
     *
     * @param string $p2
     * @param int $charSum
     *
     * @return string
     */
    private function getPart2Remainder(string $p2, int $charSum):string
    {
        $hkid_sum = $this->calPart2Remainder($p2, $charSum);

        switch ($hkid_sum) {
            case 11:
                $hkid_sum = 0;
                break;
            case 10:
                $hkid_sum = 'A';
                break;
        }

        return (string)$hkid_sum;
    }

    /**
     * Cal Part 2 Remainder
     *
     * @param string $p2
     * @param int $charSum
     *
     * @return int
     */
    private function calPart2Remainder(string $p2, int $charSum): int
    {
        return 11 - ((
                    $charSum +
                    $p2[0] * 7 +
                    $p2[1] * 6 +
                    $p2[2] * 5 +
                    $p2[3] * 4 +
                    $p2[4] * 3 +
                    $p2[5] * 2
                ) % 11);
    }

    /**
     * set up variable for cal for part1
     *
     * @return array
     */
    private function getCharNumValue(): array
    {
        $i = 10;
        $id_check_ar = [];
        foreach (range('A', 'Z') as $char) {
            $id_check_ar[$char] = $i++;
        }

        return $id_check_ar;
    }
}
