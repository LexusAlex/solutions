<?php

declare(strict_types=1);

use Slim\App;

use Solutions\Ci\Http\Controllers;
use Tuupola\Middleware\HttpBasicAuthentication;

return static function (App $app): void {
    $app->get('/', Controllers\IndexController\HomeAction::class)->setName('home')->add(HttpBasicAuthentication::class);
    $app->map(['GET', 'POST'],'/category/create', Controllers\CategoryController\CreateAction::class)->add(HttpBasicAuthentication::class);
    $app->get('/category/list', Controllers\CategoryController\ListAction::class)->add(HttpBasicAuthentication::class);
};
