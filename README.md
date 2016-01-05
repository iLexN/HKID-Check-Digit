[![Build Status](https://travis-ci.org/iLexN/HKID-Check-Digit.svg?branch=master)](https://travis-ci.org/iLexN/HKID-Check-Digit)
[![Coverage Status](https://coveralls.io/repos/iLexN/HKID-Check-Digit/badge.svg?branch=master&service=github)](https://coveralls.io/github/iLexN/HKID-Check-Digit?branch=master)
[![StyleCI](https://styleci.io/repos/47378522/shield)](https://styleci.io/repos/47378522)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/iLexN/HKID-Check-Digit/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/iLexN/HKID-Check-Digit/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/9b916edb-0aa6-4811-a2e3-b9acbb1d4250/mini.png)](https://insight.sensiolabs.com/projects/9b916edb-0aa6-4811-a2e3-b9acbb1d4250)

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
