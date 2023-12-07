<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {

    $rectorConfig->sets([
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::CODING_STYLE,
        SetList::PHP_83,
        PHPUnitSetList::PHPUNIT_100,
        PHPUnitSetList::PHPUNIT_CODE_QUALITY,
    ]);
};
