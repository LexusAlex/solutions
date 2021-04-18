<?php

declare(strict_types=1);

namespace Solutions\Ci\Http\Middleware;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Views\PhpRenderer;
use Solutions\Ci\Http\Response\HtmlResponse;
use Solutions\Ci\Http\Validator\ValidationException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ValidationExceptionHandler implements MiddlewareInterface
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
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (ValidationException $exception) {

            $response = $this->responseFactory->createResponse()->withStatus(422);
            //$errorMessage = sprintf('%s %s', 422, $response->getReasonPhrase());
            $response = new HtmlResponse(200);

            return $this->view->render($response, 'controllers/.'.$request->getUri()->getPath().'.php',['title' => '','errors' => self::errorsArray($exception->getViolations())]);
        }
    }

    private static function errorsArray(ConstraintViolationListInterface $violations): array
    {
        $errors = [];
        /** @var ConstraintViolationInterface $violation */
        foreach ($violations as $violation) {
            $errors[$violation->getPropertyPath()] = $violation->getMessage();
        }
        return $errors;
    }
}