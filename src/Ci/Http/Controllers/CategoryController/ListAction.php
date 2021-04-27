<?php

declare(strict_types=1);

namespace Solutions\Ci\Http\Controllers\CategoryController;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Views\PhpRenderer;
use Solutions\Ci\Http\Response\HtmlResponse;
use Solutions\Modules\Solutions\Query\GetCategories\GetCategories;


class ListAction implements RequestHandlerInterface
{

    private PhpRenderer $view;
    private GetCategories $handler;

    public function __construct(PhpRenderer $view, GetCategories $handler)
    {
        $this->view = $view;
        $this->handler = $handler;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = new HtmlResponse();

        $categories = $this->handler->handle();
        //$categories = buildTreeFromArray($categories);
        //$categories[0]['children'][1]
        return $this->view->render($response, 'controllers/category/list.php', ['title' => 'Список категорий', 'categories' => $categories]);
    }
}
