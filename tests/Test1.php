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
    
        
        $p1 = 'q';
        $p2 = '126331';
        $p3 = '1';
        $a = \Ilex\Validation\HkidCheckDigit::checkHKIDFormat($p1, $p2, $p3);
        $this->assertTrue($a);
        
    }
}
