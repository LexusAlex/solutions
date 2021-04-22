<?php

declare(strict_types=1);

namespace Solutions\Ci\Http\Controllers\CategoryController;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Views\PhpRenderer;
use Solutions\Ci\Http\Response\HtmlResponse;
use Solutions\Modules\Solutions\Query\GetCategories\Handler;


class ListAction implements RequestHandlerInterface
{

    private PhpRenderer $view;
    private Handler $handler;

    public function __construct(PhpRenderer $view, Handler $handler)
    {
        $this->view = $view;
        $this->handler = $handler;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = new HtmlResponse();

        $categories = $this->handler->handle();

        return $this->view->render($response, 'controllers/category/list.php', ['title' => 'Список категорий', 'categories' => $categories]);
    }
}
