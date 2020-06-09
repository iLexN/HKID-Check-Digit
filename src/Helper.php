<?php

namespace Ilex\Validation\HkidValidation;

/**
 * Class Factory
 * Helper for Quick check
 *
 * @package Ilex\Validation\HkidValidation
 */
final class Helper
{
    private static ?HkidDigitCheck $instance;

    private static function getInstance(): HkidDigitCheck
    {
        return self::$instance ??= new HkidDigitCheck();
    }

    /**
     * Quick Helper check HKID Format eg. CA182361(1).
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     *
     * @return HkIdValidResult
     */
    public static function checkByParts(
        string $p1,
        string $p2,
        string $p3
    ): HkIdValidResult {
        return self::getInstance()->checkParts($p1, $p2, $p3);
    }

    /**
     * Quick Helper check HKID Format eg. CA182361(1).
     *
     * @param string $string CA182361(1)
     *
     * @return HkIdValidResult
     */
    public static function checkByString(string $string): HkIdValidResult
    {
        return self::getInstance()->checkString($string);
    }
}
