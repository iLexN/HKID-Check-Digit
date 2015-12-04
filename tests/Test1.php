<?php

class Test1 extends PHPUnit_Framework_TestCase
{
    
    /**
     * @dataProvider additionProvider
     */
    public function testCheckHKIDFormat($p1, $p2, $p)
    {
        $a = \Ilex\Validation\HkidCheckDigit::checkHKIDFormat($p1, $p2, $p3);
        $this->assertTrue($a);
        
    }
    
    public function additionProvider()
    {
        return array(
          array('B', '111111', '1'),
          array('C', '182361', '1'),//CA182361(1) 
          array('ZA', '182361', '3')//ZA182361(3)
        );
    }
}
