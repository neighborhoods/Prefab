<?php
declare(strict_types=1);

use Symfony\Component\DependencyInjection\Definition;
use Zend\Expressive\Handler\NotFoundHandler;
use Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware;
use Zend\Expressive\Helper\ServerUrlMiddleware;
use Zend\Expressive\Helper\UrlHelperMiddleware;
use Zend\Expressive\Router\Middleware\DispatchMiddleware;
use Zend\Expressive\Router\Middleware\ImplicitHeadMiddleware;
use Zend\Expressive\Router\Middleware\ImplicitOptionsMiddleware;
use Zend\Expressive\Router\Middleware\MethodNotAllowedMiddleware;
use Zend\Expressive\Router\Middleware\RouteMiddleware;
use Zend\ProblemDetails\ProblemDetailsMiddleware;
use Zend\ProblemDetails\ProblemDetailsNotFoundHandler;
use Zend\Stratigility\Middleware\ErrorHandler;

return function (Definition $applicationServiceDefinition): void {
    // The error handler should be the first (most outer) middleware to catch
    // all Exceptions.
    $applicationServiceDefinition->addMethodCall('pipe', [ErrorHandler::class]);
    $applicationServiceDefinition->addMethodCall('pipe', [ServerUrlMiddleware::class]);
    $applicationServiceDefinition->addMethodCall('pipe', [ProblemDetailsMiddleware::class]);

    // Pipe more middleware here that you want to execute on every request:
    // - bootstrapping
    // - pre-conditions
    // - modifications to outgoing responses
    //
    // Piped Middleware may be either callables or service names. Middleware may
    // also be passed as an array; each item in the array must resolve to
    // middleware eventually (i.e., callable or service name).
    //
    // Middleware can be attached to specific paths, allowing you to mix and match
    // applications under a common domain.  The handlers in each middleware
    // attached this way will see a URI with the matched path segment removed.
    //
    // i.e., path of "/api/member/profile" only passes "/member/profile" to $apiMiddleware
    // - $app->pipe('/api', $apiMiddleware);
    // - $app->pipe('/docs', $apiDocMiddleware);
    // - $app->pipe('/files', $filesMiddleware);

    // Register the routing middleware in the middleware pipeline.
    // This middleware registers the Zend\Expressive\Router\RouteResult request attribute.
    $applicationServiceDefinition->addMethodCall('pipe', [RouteMiddleware::class]);

    // The following handle routing failures for common conditions:
    // - HEAD request but no routes answer that method
    // - OPTIONS request but no routes answer that method
    // - method not allowed
    // Order here matters; the MethodNotAllowedMiddleware should be placed
    // after the Implicit*Middleware.
    $applicationServiceDefinition->addMethodCall('pipe', [BodyParamsMiddleware::class]);
    $applicationServiceDefinition->addMethodCall('pipe', [ImplicitHeadMiddleware::class]);
    $applicationServiceDefinition->addMethodCall('pipe', [ImplicitOptionsMiddleware::class]);
    $applicationServiceDefinition->addMethodCall('pipe', [MethodNotAllowedMiddleware::class]);

    // Seed the UrlHelper with the routing results:
    $applicationServiceDefinition->addMethodCall('pipe', [UrlHelperMiddleware::class]);

    // Add more middleware here that needs to introspect the routing results; this
    // might include:
    //
    // - route-based authentication
    // - route-based validation
    // - etc.

    // Register the dispatch middleware in the middleware pipeline
    $applicationServiceDefinition->addMethodCall('pipe', [DispatchMiddleware::class]);

    // At this point, if no Response is returned by any middleware, the
    // NotFoundHandler kicks in; alternately, you can provide other fallback
    // middleware to execute.
    $applicationServiceDefinition->addMethodCall('pipe', [ProblemDetailsNotFoundHandler::class]);
};
