<?php

declare(strict_types=1);

namespace Solutions\Ci\Http\Controllers\CategoryController;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Views\PhpRenderer;
use Solutions\Ci\Http\Response\HtmlResponse;
use Solutions\Modules\Solutions\Query\GetCategories\GetCategories;
use Solutions\Support\BreadcrumbsTree;
use Solutions\Support\HtmlTree;


class ViewAction
{

    private PhpRenderer $view;
    private GetCategories $handler;

    public function __construct(PhpRenderer $view, GetCategories $handler)
    {
        $this->view = $view;
        $this->handler = $handler;
    }

    public function view(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $response = new HtmlResponse();

        $categories = $this->handler->handle();

        $treeCategories = HtmlTree::create($categories, ['parent' => 'parent_id'],[],false);

        $htmlCategories = $treeCategories->showTree();

        $idCategory = $args['id'];

        //$breadcrumbs = BreadcrumbsTree::create($categories, ['parent' => 'parent_id'],[],false);
        //$node = ['parent_id' => $idCategory];
        //echo $breadcrumbs->getParents($node);

        return $this->view->render($response, 'controllers/category/view.php', ['title' => 'Категория', 'category' => $htmlCategories]);
    }
}
