<?php

namespace Ilex\Validation\HkidValidation;

/**
 * Class Factory
 * Helper for Quick check
 *
 * @package Ilex\Validation\HkidValidation
 */
class Helper
{

    /**
     * Quick Helper check HKID Format eg. CA182361(1).
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     *
     * @return bool
     */
    public static function checkByParts(
        string $p1,
        string $p2,
        string $p3
    ): bool {
        return (new HkidDigitCheck())->checkParts($p1, $p2, $p3);
    }

    /**
     * Quick Helper check HKID Format eg. CA182361(1).
     *
     * @param string $string CA182361(1)
     *
     * @return bool
     */
    public static function checkByString(string $string): bool
    {
        return (new HkidDigitCheck())->checkString($string);
    }
}
