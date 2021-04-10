<?php

declare(strict_types=1);

use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use Solutions\Ci\Http\Middleware\HttpExceptionMiddleware;

return static function (App $app): void {
    $app->addBodyParsingMiddleware();
    //$app->addRoutingMiddleware();
    //$app->addErrorMiddleware(true, true, true);
    $app->add(HttpExceptionMiddleware::class);
    $app->add(ErrorMiddleware::class);
};
