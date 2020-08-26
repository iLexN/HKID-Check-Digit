<?php

declare(strict_types=1);

use Rector\CodingStyle\Rector\Class_\AddArrayDefaultToArrayPropertyRector;
use Rector\CodingStyle\Rector\Switch_\BinarySwitchToIfElseRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set('sets', ['code-quality', 'dead-code', 'coding-style', 'php-70', 'php-71', 'php-72', 'php-73', 'php-74', 'solid']);

    $parameters->set('exclude_rectors', [BinarySwitchToIfElseRector::class, AddArrayDefaultToArrayPropertyRector::class]);
};
