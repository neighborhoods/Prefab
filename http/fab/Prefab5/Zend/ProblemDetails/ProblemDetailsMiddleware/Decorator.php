<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Zend\ProblemDetails\ProblemDetailsMiddleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Zend;

class Decorator implements DecoratorInterface
{
    use Zend\ProblemDetails\ProblemDetailsMiddleware\Decorator\AwareTrait;
    use Zend\ProblemDetails\ProblemDetailsMiddleware\AwareTrait;

    public function attachListener(callable $listener): void
    {
        if ($this->hasZendProblemDetailsProblemDetailsMiddlewareDecorator()) {
            $this->getZendProblemDetailsProblemDetailsMiddlewareDecorator()->attachListener($listener);
        } else {
            $this->getZendProblemDetailsProblemDetailsMiddleware()->attachListener($listener);
        }
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($this->hasZendProblemDetailsProblemDetailsMiddlewareDecorator()) {
            $response = $this->getZendProblemDetailsProblemDetailsMiddlewareDecorator()->process($request, $handler);
        } else {
            $response = $this->getZendProblemDetailsProblemDetailsMiddleware()->process($request, $handler);
        }

        return $response;
    }
}
