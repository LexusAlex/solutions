<?php

declare(strict_types=1);

use Slim\App;

use Solutions\Ci\Http\Controllers;

return static function (App $app): void {
    $app->get('/', Controllers\IndexController\HomeAction::class)->setName('home');
};
