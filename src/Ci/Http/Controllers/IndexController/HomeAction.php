<?php

declare(strict_types=1);

namespace Solutions\Ci\Http\Controllers\IndexController;

use App\Domain\User\Repository\CategoryRepository;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Views\PhpRenderer;
use Solutions\Ci\Http\Response\HtmlResponse;


class HomeAction implements RequestHandlerInterface
{

    private PhpRenderer $view;
    private CategoryRepository $CategoryRepository;

    public function __construct(PhpRenderer $view, PDO $connection)
    {
        $this->view = $view;
        $this->connection = $connection;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = new HtmlResponse();
        var_dump($this->connection);
        return $this->view->render($response, 'controllers/index/home.php', ['d' => '1234213213213213123']);
    }
}
