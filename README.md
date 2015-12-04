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


ref : http://keatonchan.blogspot.hk/2009/08/hkid-check-digit-calculation-algorithm.html