<?php

namespace Ilex\Validation;

class HkidCheckDigit
{
    /**
     * check HKID Format eg. CA182361(1).
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     *
     * @return bool
     */
    public static function checkHKIDFormat($p1, $p2, $p3)
    {
        $p1_c = strtoupper(trim($p1));

        $i = 10;

        $id_check_ar = [];
        foreach (range('A', 'Z') as $char) {
            $id_check_ar[$char] = $i;
            ++$i;
        }

        $countChat = strlen(trim($p1_c));
        if ($countChat == 1) {
            $chatSum = 324 + $id_check_ar[$p1_c[0]] * 8;
        } elseif ($countChat == 2) {
            $chatSum = $id_check_ar[$p1_c[0]] * 9;
            $chatSum += $id_check_ar[$p1_c[1]] * 8;
        } else {
            return false;
        }

        $hkid_sum = 11 - ((
            $chatSum +
            $p2[0] * 7 +
            $p2[1] * 6 +
            $p2[2] * 5 +
            $p2[3] * 4 +
            $p2[4] * 3 +
            $p2[5] * 2) % 11);

        switch ($hkid_sum) {
            case 11:
                $hkid_sum = 0;
                break;
            case 10:
                $hkid_sum = 'A';
                break;
        }

        if ($hkid_sum == strtoupper($p3)) {
            return true;
        }

        return false;
    }
}
