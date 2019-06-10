# Validation of HKID
> Used to validation the format and check digit calculation for HKID 

[![Build Status](https://travis-ci.org/iLexN/HKID-Check-Digit.svg?branch=2.x)](https://travis-ci.org/iLexN/HKID-Check-Digit)
[![Coverage Status](https://coveralls.io/repos/github/iLexN/HKID-Check-Digit/badge.svg?branch=2.x)](https://coveralls.io/github/iLexN/HKID-Check-Digit?branch=2.x)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/iLexN/HKID-Check-Digit/badges/quality-score.png?b=2.x)](https://scrutinizer-ci.com/g/iLexN/HKID-Check-Digit/?branch=2.x)
[![Infection MSI](https://badge.stryker-mutator.io/github.com/iLexN/HKID-Check-Digit/2.x)](https://infection.github.io)

| Tag | PHP      |
|-----|----------|
| 1.x |          |
| 2.x | php>=7.1 |

## Installation
```sh
composer require ilexn/hkid-check-digit
```
## Usage example
#### Quick helper - check by each part
```php
<?php
use Ilex\Validation\HkidValidation\Helper;

require_once '../vendor/autoload.php';

$p1 = 'CA';
$p2 = '182361';
$p3 = '1';

$a = Helper::checkByParts($p1, $p2, $p3);

if ($a === true) {
    echo ('correct');
} else {
    echo ('wrong');
}
```
#### Quick helper - check by string
```php
<?php
use Ilex\Validation\HkidValidation\Helper;

require_once './vendor/autoload.php';

$s = 'CA182361(1)';

$a = Helper::checkByString($s);

if ($a === true) {
    echo ('correct');
} else {
    echo ('wrong');
}
```
#### Normal 
```php
<?php
use Ilex\Validation\HkidValidation\HkidDigitCheck;

require_once '../vendor/autoload.php';

$p1 = 'CA';
$p2 = '182361';
$p3 = '1';
$s = 'CA182361(1)';

$c = new HkidDigitCheck();

if ($c->checkParts($p1,$p2,$p3) === true) {
    echo ('correct');
} else {
    echo ('wrong');
}

if ($c->checkByString($s) === true) {
    echo ('correct');
} else {
    echo ('wrong');
}
```
## API
Please refer to the [docs].

<!-- Markdown link & img dfn's -->
[Example]: https://github.com/iLexN/keep-a-change-log/tree/master/example
[docs]: https://ilexn.github.io/HKID-Check-Digit/
