<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Tuupola\Middleware\HttpBasicAuthentication;

return [
    HttpBasicAuthentication::class => function (ContainerInterface $container) {
        $settings["users"][getenv('SOLUTIONS_USER')] = getenv('SOLUTIONS_PASS');
        return new HttpBasicAuthentication($settings);
    },
];