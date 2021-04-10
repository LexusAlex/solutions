<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Psr\Container\ContainerInterface;

http_response_code(500);

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();

/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/app/container.php';

$application = (require __DIR__ . '/../config/app/application.php')($container);

$application->run();