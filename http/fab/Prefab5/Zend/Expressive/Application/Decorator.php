<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Zend\Expressive\Application;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Zend;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Router;

class Decorator implements DecoratorInterface
{
    use Zend\Expressive\Application\AwareTrait;
    use Zend\Expressive\Application\Decorator\AwareTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($this->hasZendExpressiveApplicationDecorator()) {
            $response = $this->getZendExpressiveApplicationDecorator()->handle($request);
        } else {
            $response = $this->getZendExpressiveApplication()->handle($request);
        }

        return $response;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($this->hasZendExpressiveApplicationDecorator()) {
            $response = $this->getZendExpressiveApplicationDecorator()->process($request, $handler);;
        } else {
            $response = $this->getZendExpressiveApplication()->process($request, $handler);;
        }

        return $response;
    }

    public function run(): void
    {
        if ($this->hasZendExpressiveApplicationDecorator()) {
            $this->getZendExpressiveApplicationDecorator()->run();
        } else {
            $this->getZendExpressiveApplication()->run();
        }
    }

    public function pipe($middlewareOrPath, $middleware = null): void
    {
        if ($this->hasZendExpressiveApplicationDecorator()) {
            $this->getZendExpressiveApplicationDecorator()->pipe($middlewareOrPath, $middleware);
        } else {
            $this->getZendExpressiveApplication()->pipe($middlewareOrPath, $middleware);
        }
    }

    public function route(string $path, $middleware, array $methods = null, string $name = null): Router\Route
    {
        if ($this->hasZendExpressiveApplicationDecorator()) {
            $route = $this->getZendExpressiveApplicationDecorator()->route($path, $middleware, $methods, $name);
        } else {
            $route = $this->getZendExpressiveApplication()->route($path, $middleware, $methods, $name);
        }

        return $route;
    }

    public function get(string $path, $middleware, string $name = null): Router\Route
    {
        if ($this->hasZendExpressiveApplicationDecorator()) {
            $route = $this->getZendExpressiveApplicationDecorator()->get($path, $middleware, $name . '-GET');
        } else {
            $route = $this->getZendExpressiveApplication()->get($path, $middleware, $name . '-GET');
        }

        return $route;
    }

    public function post(string $path, $middleware, $name = null): Router\Route
    {
        if ($this->hasZendExpressiveApplicationDecorator()) {
            $route = $this->getZendExpressiveApplicationDecorator()->post($path, $middleware, $name . '-POST');
        } else {
            $route = $this->getZendExpressiveApplication()->post($path, $middleware, $name . '-POST');
        }

        return $route;
    }

    public function put(string $path, $middleware, string $name = null): Router\Route
    {
        if ($this->hasZendExpressiveApplicationDecorator()) {
            $route = $this->getZendExpressiveApplicationDecorator()->put($path, $middleware, $name . '-PUT');
        } else {
            $route = $this->getZendExpressiveApplication()->put($path, $middleware, $name . '-PUT');
        }

        return $route;
    }

    public function patch(string $path, $middleware, string $name = null): Router\Route
    {
        if ($this->hasZendExpressiveApplicationDecorator()) {
            $route = $this->getZendExpressiveApplicationDecorator()->patch($path, $middleware, $name . '-PATCH');
        } else {
            $route = $this->getZendExpressiveApplication()->patch($path, $middleware, $name . '-PATCH');
        }

        return $route;
    }

    public function delete(string $path, $middleware, string $name = null): Router\Route
    {
        if ($this->hasZendExpressiveApplicationDecorator()) {
            $route = $this->getZendExpressiveApplicationDecorator()->delete($path, $middleware, $name . '-DELETE');
        } else {
            $route = $this->getZendExpressiveApplication()->delete($path, $middleware, $name . '-DELETE');
        }

        return $route;
    }

    public function any(string $path, $middleware, string $name = null): Router\Route
    {
        if ($this->hasZendExpressiveApplicationDecorator()) {
            $route = $this->getZendExpressiveApplicationDecorator()($path, $middleware, $name . '-ANY');
        } else {
            $route = $this->getZendExpressiveApplication()->any($path, $middleware, $name . '-ANY');
        }

        return $route;
    }

    public function getRoutes(): array
    {
        if ($this->hasZendExpressiveApplicationDecorator()) {
            $routes = $this->getZendExpressiveApplicationDecorator()->getRoutes();
        } else {
            $routes = $this->getZendExpressiveApplication()->getRoutes();
        }

        return $routes;
    }
}
