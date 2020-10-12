<?php

declare(strict_types=1);

use Rector\CodingStyle\Rector\Class_\AddArrayDefaultToArrayPropertyRector;
use Rector\CodingStyle\Rector\Switch_\BinarySwitchToIfElseRector;
use Rector\Core\Configuration\Option;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::SETS, [
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::CODING_STYLE,
        SetList::PHP_74,
        SetList::SOLID,
        SetList::CODING_STYLE_ADVANCED,
        SetList::PERFORMANCE,
        SetList::PHPUNIT_91,
        SetList::PHPUNIT_CODE_QUALITY,
        SetList::PHPUNIT_EXCEPTION,
        SetList::PHPUNIT_MOCK,
        SetList::PHPUNIT_INJECTOR,
        SetList::PHPUNIT_YIELD_DATA_PROVIDER,
        SetList::PHPUNIT_SPECIFIC_METHOD,
        SetList::PHPSTAN,
    ]);

    $parameters->set('exclude_rectors', [
        BinarySwitchToIfElseRector::class,
        AddArrayDefaultToArrayPropertyRector::class,
    ]);

    $parameters->set(Option::EXCLUDE_PATHS, [
        __DIR__ . '/src/Helper.php',
    ]);
};
