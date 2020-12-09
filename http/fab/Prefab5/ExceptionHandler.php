<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

class ExceptionHandler implements ExceptionHandlerInterface
{
    use Logger\AwareTrait;

    public function __invoke(\Throwable $throwable): void
    {
        // send throwable to Datadog
        $repository = new \Neighborhoods\DatadogComponent\GlobalTracer\Repository();
        $tracer = $repository->get();
        $span = $tracer->getActiveSpan();
        if ($span !== null) {
            $span->setError($throwable);
        }

        if (defined('STDERR')) {
            // Should exist from a CLI context
            fwrite(STDERR, $throwable->__toString() . PHP_EOL);
        } else if (getenv('SITE_ENVIRONMENT') === 'Local') {
            // Writing to file is extremely slow and should never be done on Production from an HTTP context
            $this->getPrefab5Logger()->critical($throwable->__toString() . PHP_EOL);
        }

        exit(255);
    }
}
