<?php

namespace Solutions\Ci\Http\Middleware;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpException;
use Slim\Views\PhpRenderer;

final class HttpExceptionMiddleware implements MiddlewareInterface
{
    /**
     * @var ResponseFactoryInterface
     */
    private ResponseFactoryInterface $responseFactory;

    private PhpRenderer $view;

    public function __construct(ResponseFactoryInterface $responseFactory, PhpRenderer $view)
    {
        $this->responseFactory = $responseFactory;
        $this->view = $view;
    }

    public function process( ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (HttpException $httpException) {
            // Handle the http exception here
            $statusCode = $httpException->getCode();
            $response = $this->responseFactory->createResponse()->withStatus($statusCode);
            $errorMessage = sprintf('%s %s', $statusCode, $response->getReasonPhrase());

            // Log the error message
            // $this->logger->error($errorMessage);

            // Render twig template or just add the content to the body
            //$response->getBody()->write($errorMessage);

            //return $response;
            return $this->view->render($response, 'controllers/http/error.php',['error' => $errorMessage]);
        }
    }
}
