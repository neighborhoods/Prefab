<?php

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic;
use Zend\Expressive\Router\RouteResult;

class TransactionNameMiddleware implements TransactionNameMiddlewareInterface
{
    use NewRelic\AwareTrait;

    /** @var string */
    protected $application_name;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            if ($this->hasApplicationName()) {
                $this->getNewRelic()->setAppname($this->getApplicationName());
            }
            $matchedRouteName = $request->getAttribute(RouteResult::class)->getMatchedRouteName();
            $this->getNewRelic()->nameTransaction($matchedRouteName);
        } catch (\Throwable $throwable) {
            $this->getNewRelic()->noticeThrowable($throwable);

            $repository = new \Neighborhoods\DatadogComponent\GlobalTracer\Repository();
            $tracer = $repository->get();
            $span = $tracer->getActiveSpan();
            if ($span !== null) {
                $span->setError($throwable);
            }
        }

        return $handler->handle($request);
    }

    protected function hasApplicationName(): bool
    {
        return $this->application_name !== null;
    }

    protected function getApplicationName(): string
    {
        if ($this->application_name === null) {
            throw new \LogicException('TransactionNameMiddleware application_name has not been set.');
        }

        return $this->application_name;
    }

    public function setApplicationName(string $application_name): TransactionNameMiddlewareInterface
    {
        if ($this->application_name !== null) {
            throw new \LogicException('TransactionNameMiddleware application_name is already set.');
        }
        $this->application_name = $application_name;

        return $this;
    }
}
