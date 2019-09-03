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

$nextRelease = (new Release('3.0.0','2019-xx-xx'))
    ->added('use PHP 7.4 Typed properties')
    ->added('use PHP 7.4 Short closures')
    ->added('infection test to improve test case')
    ->changed('BC: Helper class now return value object, not bool')
    ->removed('Drop support PHP <= 7.3');

$c->addRelease(
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
