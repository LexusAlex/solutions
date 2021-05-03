<?php

declare(strict_types=1);

namespace Solutions\Ci\Http\Controllers\CategoryController;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;
use Solutions\Ci\Http\Response\HtmlResponse;
use Solutions\Ci\Http\Validator\Validator;
use Solutions\Modules\Solutions\Command\UpdateCategory\Handler;
use Solutions\Modules\Solutions\Command\UpdateCategory\Command;
use Solutions\Modules\Solutions\Entity\Category\Id;
use Solutions\Modules\Solutions\Query\GetCategories\GetCategories;
use Solutions\Modules\Solutions\Query\GetCategory\GetCategory;

class UpdateAction
{

    private PhpRenderer $view;
    private Handler $handler;
    private Validator $validator;
    private GetCategories $getCategories;
    private GetCategory $getCategory;

    public function __construct(PhpRenderer $view, Handler $handler, Validator $validator, GetCategories $getCategories, GetCategory $getCategory)
    {
        $this->view = $view;
        $this->handler = $handler;
        $this->validator = $validator;
        $this->getCategories = $getCategories;
        $this->getCategory = $getCategory;
    }

    public function update(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $method = $request->getMethod();
        $response = new HtmlResponse();
        $categories = $this->getCategories->handle();
        $category = $this->getCategory->handle($args['id']);
        if ($method === 'POST') {
            $data = $request->getParsedBody();
            $command = new Command();
            $command->title = $data['Category']['title'] ?? '';
            $command->parent_id = $data['Category']['parent_id'] ?? '0';


            //$this->validator->validate($command);
            $id = new Id($category->id);
            $created_at = new \DateTimeImmutable($category->created_at);
            $this->handler->handle($command,['id' => $id,'created_at' => $created_at]);

            return $response->withRedirect($response, '/');
        }
        return $this->view->render($response, 'controllers/category/update.php', ['title' => 'Редактировать категорию "' . $category->title.'"','cat' => $categories,'category' => $category,'errors' => []]);
    }
}
