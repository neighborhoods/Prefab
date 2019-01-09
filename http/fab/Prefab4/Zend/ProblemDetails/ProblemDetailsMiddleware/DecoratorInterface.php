<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Zend\ProblemDetails\ProblemDetailsMiddleware;

use Psr\Http\Server\MiddlewareInterface;

interface DecoratorInterface extends MiddlewareInterface
{
    public function attachListener(callable $listener): void;
}
