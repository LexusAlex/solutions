<?php

declare(strict_types=1);

namespace Solutions\Ci\Http\Response;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Response;

class HtmlResponse extends Response
{
    /**
     * @param string $data
     * @param int $status
     */
    public function __construct(int $status = 200)
    {
        parent::__construct(
            $status,
            null,
            //(new StreamFactory())->createStream($data)
        );
    }

    public function withRedirect(ResponseInterface $response, string $destination, array $queryParams = []): ResponseInterface {
        if ($queryParams) {
            $destination = sprintf('%s?%s', $destination, http_build_query($queryParams));
        }

        return $response->withStatus(302)->withHeader('Location', $destination);
    }
}