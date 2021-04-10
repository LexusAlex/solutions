<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;

$builder = new ContainerBuilder();

$aggregator = new ConfigAggregator([
    new PhpFileProvider(__DIR__ . '/../main/*.php'),
    //new PhpFileProvider(__DIR__ . '/' . (getenv('PHP_COMPACT_ENV') ?: 'prod') . '/../*.php'),
]);

$builder->addDefinitions($aggregator->getMergedConfig());

try {
    return $builder->build();
} catch (Exception $e) {
}
