<?php

namespace Ilex\Validation;

class HkidCheckDigit
{
    public $p1;
    public $p2;
    public $p3;

    public function __construct($p1, $p2, $p3)
    {
        $this->p1 = strtoupper(trim($p1));
        $this->p2 = $p2;
        $this->p3 = strtoupper($p3);
    }

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
        $hkidObj = new self($p1, $p2, $p3);

        return $hkidObj->checkHKID();
    }

    public function checkHKID()
    {
        $chatSum = $this->getchatSum();
        if ($chatSum  === false) {
            return false;
        }

        $hkid_sum = $this->getP1P2Sum($chatSum);

        if ($hkid_sum == $this->p3) {
            return true;
        }

        return false;
    }

    private function getchatSum()
    {
        $p1_c = $this->p1;
        $id_check_ar = $this->getChatNum();
        $countChat = strlen(trim($p1_c));

        if ($countChat === 1) {
            return 324 + $id_check_ar[$p1_c[0]] * 8;
        } elseif ($countChat === 2) {
            return $id_check_ar[$p1_c[0]] * 9 + $id_check_ar[$p1_c[1]] * 8;
        } else {
            return false;
        }
    }

    private function getP1P2Sum($chatSum)
    {
        $p2 = $this->p2;
        $hkid_sum =  11 - ((
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
        return $hkid_sum;
    }

    private function getChatNum()
    {
        $i = 10;
        $id_check_ar = [];
        foreach (range('A', 'Z') as $char) {
            $id_check_ar[$char] = $i;
            ++$i;
        }

        return $id_check_ar;
    }
}
