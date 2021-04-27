<?php

declare(strict_types=1);

namespace Solutions\Ci\Http\Controllers\CategoryController;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Views\PhpRenderer;
use Solutions\Ci\Http\Response\HtmlResponse;
use Solutions\Ci\Http\Validator\Validator;
use Solutions\Modules\Solutions\Command\AddCategory\Command;
use Solutions\Modules\Solutions\Command\AddCategory\Handler;
use Solutions\Modules\Solutions\Query\GetCategories\GetCategories;

class CreateAction implements RequestHandlerInterface
{

    private PhpRenderer $view;
    private Handler $handler;
    private Validator $validator;
    private GetCategories $getCategories;

    public function __construct(PhpRenderer $view, Handler $handler, Validator $validator, GetCategories $getCategories)
    {
        $this->view = $view;
        $this->handler = $handler;
        $this->validator = $validator;
        $this->getCategories = $getCategories;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $method = $request->getMethod();
        $response = new HtmlResponse();
        $categories = $this->getCategories->handle();
        if ($method === 'POST') {
            $data = $request->getParsedBody();
            $command = new Command();
            $command->title = $data['Category']['title'] ?? '';
            $command->parent_id = $data['Category']['parent_id'] ?? '0';

            $this->validator->validate($command);
            $this->handler->handle($command);

            return $response->withRedirect($response, '/category/list');
        }
        return $this->view->render($response, 'controllers/category/create.php', ['title' => 'Создать категорию','categories' => $categories,'errors' => []]);
    }
}
