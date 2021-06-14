<?php

declare(strict_types=1);

use Slim\App;

use Solutions\Ci\Http\Controllers;

return static function (App $app): void {
    $app->get('/', Controllers\IndexController\HomeAction::class)->setName('home');
    $app->map(['GET', 'POST'],'/category/create', Controllers\CategoryController\CreateAction::class);
    $app->get('/category/view/{id}', Controllers\CategoryController\ViewAction::class.':view');
    $app->map(['GET', 'POST'],'/category/update/{id}', Controllers\CategoryController\UpdateAction::class.':update');
};
