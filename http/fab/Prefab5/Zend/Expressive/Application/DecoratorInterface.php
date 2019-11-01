<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Zend\Expressive\Application;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Router;

interface DecoratorInterface extends MiddlewareInterface, RequestHandlerInterface
{
    public function run(): void;

    public function pipe($middlewareOrPath, $middleware = null): void;

    public function route(string $path, $middleware, array $methods = null, string $name = null): Router\Route;

    public function get(string $path, $middleware, string $name = null): Router\Route;

    public function post(string $path, $middleware, $name = null): Router\Route;

    public function put(string $path, $middleware, string $name = null): Router\Route;

    public function patch(string $path, $middleware, string $name = null): Router\Route;

    public function delete(string $path, $middleware, string $name = null): Router\Route;

    public function any(string $path, $middleware, string $name = null): Router\Route;

    public function getRoutes(): array;
}
