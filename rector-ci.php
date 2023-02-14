<?php

declare(strict_types=1);

use Rector\CodingStyle\Rector\Class_\AddArrayDefaultToArrayPropertyRector;
use Rector\CodingStyle\Rector\Switch_\BinarySwitchToIfElseRector;
use Rector\Config\RectorConfig;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {

    $rectorConfig->sets([
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::CODING_STYLE,
        SetList::PHP_74,
        SetList::PHP_80,
        SetList::PHP_81,
        SetList::PHP_82,
        PHPUnitSetList::PHPUNIT_91,
        PHPUnitSetList::PHPUNIT_100,
        PHPUnitSetList::PHPUNIT_CODE_QUALITY,
        PHPUnitSetList::PHPUNIT_EXCEPTION,
        PHPUnitSetList::PHPUNIT_YIELD_DATA_PROVIDER,
        PHPUnitSetList::PHPUNIT_EXCEPTION,
        PHPUnitSetList::PHPUNIT_YIELD_DATA_PROVIDER,
        PHPUnitSetList::PHPUNIT_SPECIFIC_METHOD,
    ]);

    $rectorConfig->skip([
        BinarySwitchToIfElseRector::class,
        AddArrayDefaultToArrayPropertyRector::class,
        Rector\Php80\Rector\FunctionLike\UnionTypesRector::class,
        Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector::class,
        Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector::class,
//        __DIR__ . '/src/Helper.php',
    ]);
};
