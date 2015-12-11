[![Build Status](https://travis-ci.org/iLexN/HKID-Check-Digit.svg?branch=master)](https://travis-ci.org/iLexN/HKID-Check-Digit)
[![Coverage Status](https://coveralls.io/repos/iLexN/HKID-Check-Digit/badge.svg?branch=master&service=github)](https://coveralls.io/github/iLexN/HKID-Check-Digit?branch=master)


# How to autoload


    require_once '../vendor/autoload.php';
    //CA182361(1) 
    $p1 = 'CA';
    $p2 = '182361';
    $p3 = '1';
    $a = \Ilex\Validation\HkidCheckDigit::checkHKIDFormat($p1, $p2, $p3);
    if ( $a ) {
        echo('Good');
    } else {
        echo('Wrong');
    }


# Remember
- website need SSL ,
- do not save the data , or encode to save

ref : http://keatonchan.blogspot.hk/2009/08/hkid-check-digit-calculation-algorithm.html