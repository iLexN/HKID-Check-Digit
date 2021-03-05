<?php

use Ilex\ChangeLog\ChangeLog;
use Ilex\ChangeLog\Formatter\DefaultFormatter;
use Ilex\ChangeLog\Release;

require(__DIR__ . '/../vendor/autoload.php');

$c = new ChangeLog(
    'Change Log',
    'All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).',
    new DefaultFormatter('https://github.com/iLexN/HKID-Check-Digit/compare')
);

$c->addRelease((new Release('4.0.0','2020-03-05'))
    ->added('Support PHP 8')
    ->removed('Drop Support PHP 7')
);

$c->addRelease((new Release('3.1.2','2020-06-09'))
    ->added('Reuse the class in Helper')
);

$c->addRelease((new Release('3.1.1','2020-06-09'))
    ->added('Reuse the class in Helper')
);

$c->addRelease((new Release('3.1.0','2020-03-16'))
    ->added('New const for regx')
    ->added('HKID null value object')
    ->removed('Invalid Exception')
);

$c->addRelease(
    (new Release('3.0.0','2019-11-28'))
        ->added('use PHP 7.4 Typed properties')
        ->added('use PHP 7.4 Short closures')
        ->added('infection test to improve test case')
        ->added('Value Object and Result Value Object')
        ->added('Reason to Result value object')
        ->added('New Invalid Exception Class')
        ->changed('BC: Helper class now return result value object, not bool')
        ->removed('Drop support PHP <= 7.3')
)->addRelease(
    (new Release('2.0.2', '2019-09-23'))
        ->fixed('Fix some typo')
        ->added('Add const')
)->addRelease(
    (new Release('2.0.1', '2019-02-02'))
        ->added('add/update dev package')
        ->fixed('phpstan error')
        ->changed('replace php-cs-fix to ecs')
)->addRelease(
    (new Release('2.0.0', '2018-01-28'))
        ->added('Help class for easy check')
        ->added('Add check by string')
        ->removed('Remove PHP<=7.0 support')
)->addRelease(
    new Release('1.0.6', '2016-01-04')
);


print($c->render());
// or save
file_put_contents(__DIR__ . '/../CHANGELOG.md', $c->render());
