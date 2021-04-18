<?php

declare(strict_types=1);

namespace Solutions\Ci\Http\Controllers\IndexController;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Views\PhpRenderer;
use Solutions\Ci\Http\Response\HtmlResponse;


class HomeAction implements RequestHandlerInterface
{

    private PhpRenderer $view;

    public function __construct(PhpRenderer $view)
    {
        $this->view = $view;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = new HtmlResponse();
        return $this->view->render($response, 'controllers/index/home.php', ['title' => 'Главная']);
    }
}
