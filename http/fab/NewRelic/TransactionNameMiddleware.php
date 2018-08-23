<?php

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\NewRelic;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Router\RouteResult;

class TransactionNameMiddleware implements MiddlewareInterface
{

    /**
     * Process an incoming server request and return a response, optionally delegating
     * response creation to a handler.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        if (extension_loaded('newrelic')) {
            try {
                $name = $request->getAttribute(RouteResult::class)->getMatchedRouteName();
                newrelic_name_transaction($name);
            } catch (\Throwable $throwable) {
                newrelic_notice_error('Transaction Naming Error', $throwable);
            }
        }

        return $handler->handle($request);
    }
}
