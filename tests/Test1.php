<?php

class Test1 extends PHPUnit_Framework_TestCase
{
    public function testCheckHKIDFormat()
    {
        $p1 = 'B';
        $p2 = '111111';
        $p3 = '1';
        $a = \Ilex\Validation\HkidCheckDigit::checkHKIDFormat($p1, $p2, $p3);
        $this->assertTrue($a);
     
        //CA182361(1) 
        $p1 = 'CA';
        $p2 = '182361';
        $p3 = '1';
        $a = \Ilex\Validation\HkidCheckDigit::checkHKIDFormat($p1, $p2, $p3);
        $this->assertTrue($a);
        
        //ZA182361(3)
        $p1 = 'ZA';
        $p2 = '182361';
        $p3 = '3';
        $a = \Ilex\Validation\HkidCheckDigit::checkHKIDFormat($p1, $p2, $p3);
        $this->assertTrue($a);
        
    }
}
