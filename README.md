# Validation of HKID
> Used to validation the format and check digit calculation for HKID 

[![Latest Stable Version](https://poser.pugx.org/ilexn/hkid-check-digit/v/stable)](https://packagist.org/packages/ilexn/hkid-check-digit)
[![Total Downloads](https://poser.pugx.org/ilexn/hkid-check-digit/downloads)](https://packagist.org/packages/ilexn/hkid-check-digit)

[![Build Status](https://travis-ci.org/iLexN/HKID-Check-Digit.svg?branch=3.x)](https://travis-ci.org/iLexN/HKID-Check-Digit)
[![Coverage Status](https://coveralls.io/repos/github/iLexN/HKID-Check-Digit/badge.svg?branch=3.x)](https://coveralls.io/github/iLexN/HKID-Check-Digit?branch=3.x)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/iLexN/HKID-Check-Digit/badges/quality-score.png?b=3.x)](https://scrutinizer-ci.com/g/iLexN/HKID-Check-Digit/?branch=3.x)
[![Infection MSI](https://badge.stryker-mutator.io/github.com/iLexN/HKID-Check-Digit/3.x)](https://infection.github.io)

| Tag | PHP      |
|-----|----------|
| 1.x |          |
| 2.x | php>=7.1 |
| 3.x | php>=7.4 |

## Installation
```sh
composer require ilexn/hkid-check-digit
```
## Usage example
#### Quick helper - check by each part
```php
<?php
use Ilex\Validation\HkidValidation\Helper;

require_once 'vendor/autoload.php';

//CA182361(1)
$p1 = 'CA';
$p2 = '182361';
$p3 = '1';

/** @var \Ilex\Validation\HkidValidation\HkIdValidResult $node */
$a = Helper::checkByParts($p1, $p2, $p3);

if ($a->isValid()) {
    echo ('correct');
    echo $a->format(); //CA182361(1)
    echo (string) $a; //CA182361(1)
} else {
    echo ('wrong');
}
```
#### Quick helper - check by string
```php
<?php
use Ilex\Validation\HkidValidation\Helper;

require_once 'vendor/autoload.php';

$s = 'CA182361(1)';

$a = Helper::checkByString($s);

if ($a->isValid()) {
    echo ('correct');
    echo $a->format();
} else {
    echo ('wrong');
}
```
#### Normal 
```php
<?php
use Ilex\Validation\HkidValidation\HkidDigitCheck;

require_once 'vendor/autoload.php';

$p1 = 'CA';
$p2 = '182361';
$p3 = '1';
$s = 'CA182361(1)';

$c = new HkidDigitCheck();
$hkid = $c->checkParts($p1,$p2,$p3);
if ($hkid->isValid()) {
    echo ('correct');
    echo $a->format();
} else {
    echo ('wrong');
}

$hkid = $c->checkString($s);
if ($hkid->isValid()) {
    echo ('correct');
    echo $a->format();
} else {
    echo ('wrong');
}
```

## Upgrade from 2.x to 3.x
All the checking now return `\Ilex\Validation\HkidValidation\HkId` object, not `bool`
```php

$a = Helper::checkByString($s);
//2.x: $a is bool

//3.x
$a is \Ilex\Validation\HkidValidation\HkId
$a->isValid(); //bool
echo($a->format); // print the formated HKID.

//also can get back each parts
echo($a->getPart1());
echo($a->getPart2());
echo($a->getPart3());
```
