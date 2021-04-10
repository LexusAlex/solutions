<?php

declare(strict_types=1);

namespace Solutions\Ci\Http\Response;

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
}