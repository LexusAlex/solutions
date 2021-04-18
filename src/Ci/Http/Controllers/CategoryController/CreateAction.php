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

class CreateAction implements RequestHandlerInterface
{

    private PhpRenderer $view;
    private Handler $handler;
    private Validator $validator;

    public function __construct(PhpRenderer $view, Handler $handler, Validator $validator)
    {
        $this->view = $view;
        $this->handler = $handler;
        $this->validator = $validator;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $method = $request->getMethod();
        $response = new HtmlResponse();

        if ($method === 'POST') {
            $data = $request->getParsedBody();
            $command = new Command();
            $command->title = $data['Category']['title'] ?? '';

            $this->validator->validate($command);
            $this->handler->handle($command);

            return $response->withRedirect($response, '/category/list');
        }
        return $this->view->render($response, 'controllers/category/create.php', ['title' => 'Создать категорию','errors' => []]);
    }
}
