<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

class ExceptionHandler implements ExceptionHandlerInterface
{
    use Logger\AwareTrait;

    public function __invoke(\Throwable $throwable): void
    {
        if (getenv('DEBUG_MODE') === 'true') {
            if (defined('STDERR')) {
                // Should exist from a CLI context
                fwrite(STDERR, $throwable->__toString() . PHP_EOL);
            }
            $this->getPrefab5Logger()->critical($throwable->__toString() . PHP_EOL);
        }

        // Try to send the error to DataDog
        $repository = new \Neighborhoods\DatadogComponent\GlobalTracer\Repository();
        $tracer = $repository->get();
        $span = $tracer->getActiveSpan();
        if ($span !== null) {
            $span->setError($throwable);
        }

        exit(255);
    }
}
