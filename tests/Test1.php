<?php

class Test1 extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testCheckHKIDFormat($p1, $p2, $p3)
    {
        $a = \Ilex\Validation\HkidCheckDigit::checkHKIDFormat($p1, $p2, $p3);
        $this->assertTrue($a);
    }
    
    public function additionProvider()
    {
        return array(
            'B111111(1)' => array('B', '111111', '1'),
            'CA182361(1)' => array('CA', '182361', '1'),
            'ZA182361(3)' => array('ZA', '182361', '3'),
            'B111112(A)' => array('B', '111112', 'A'),
            'B111117(0)' => array('B', '111117', '0'),
        );
    }
    
    public function testCheckHKIDFormatFalse()
    {
        $p1 = 'B';
        $p2 = '111111';
        $p3 = '3';
        
        $a = \Ilex\Validation\HkidCheckDigit::checkHKIDFormat($p1, $p2, $p3);
        $this->assertFalse($a);
    }
    
    
}
