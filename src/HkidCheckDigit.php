<?php
declare(strict_types=1);

namespace Ilex\Validation;

class HkidCheckDigit
{
    private $partOneCharNumArray = [];

    public function __construct()
    {
        $this->partOneCharNumArray = $this->getCharNumValue();
    }

    private function clearString(string $string):string
    {
        return strtoupper(trim($string));
    }

    /**
     * Quick Helper check HKID Format eg. CA182361(1).
     *
     * @param string $p1 CA
     * @param string $p2 182361
     * @param string $p3 1
     *
     * @return bool
     */
    public static function createFromParts(
        string $p1,
        string $p2,
        string $p3
    ): bool {
        return (new self())->check($p1, $p2, $p3);
    }

    public function check(string $p1, string $p2, string $p3): bool
    {
        $p1 = $this->clearString($p1);
        $p3 = $this->clearString($p3);

        try {
            return $this->getP1P2Sum($p2, $this->getCharSum($p1)) === $p3;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @param string $p1
     *
     * @return int
     * @throws \Exception
     */
    private function getCharSum(string $p1) : int
    {
        $countChat = strlen($p1);

        if ($countChat === 1) {
            return 324 + $this->partOneCharNumArray[$p1[0]] * 8;
        } elseif ($countChat === 2) {
            return $this->partOneCharNumArray[$p1[0]] * 9 + $this->partOneCharNumArray[$p1[1]] * 8;
        }

        throw new \Exception('Wrong length for part 1');
    }

    private function getP1P2Sum($p2, $charSum): string
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

    public function calPart2Remainder(string $p2, int $charSum) :int
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


    private function getCharNumValue()
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
