<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;

return [
    PDO::class => static function (ContainerInterface $container) {
        /**
         * @var array $configuration
         * @param array<string> $configuration
         * @psalm-suppress MixedArrayAccess
         * @psalm-suppress MixedArgument
         */
        $configuration = $container->get('configurations')['mariadb'];
        /**
         * @psalm-suppress MixedArrayAccess
         * @psalm-var array{
         *     driver:string,
         *     dbname:string,
         *     host:string,
         *     port:string,
         *     user:string,
         *     password:string,
         *     constants:array
         * } $configuration
         */
        $dsn = $configuration['driver'] .
               ':dbname=' . $configuration['dbname'] .
               ';host=' . $configuration['host']  .
               ';port=' . $configuration['port'];
        /** @psalm-suppress MixedArgument */
        return new PDO(
            $dsn,
            $configuration['user'],
            $configuration['password'],
            $configuration['constants'],
        );
    },
    'configurations' => [
        'mariadb' => [
            'driver' => 'mysql',
            'dbname' => getenv('SOLUTIONS_MARIADB_DB_NAME'),
            'host' => getenv('SOLUTIONS_MARIADB_DB_HOST'),
            'port' => getenv('SOLUTIONS_MARIADB_DB_PORT'),
            'user' => getenv('SOLUTIONS_MARIADB_DB_USER'),
            'password' => getenv('SOLUTIONS_MARIADB_DB_PASSWORD'),
            'constants' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        ],
    ],
];
