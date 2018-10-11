<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Zend\ProblemDetails\ProblemDetailsMiddleware\Log;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ListenerInterface
{
    public function __invoke(
        \Throwable $error,
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ListenerInterface;
}
