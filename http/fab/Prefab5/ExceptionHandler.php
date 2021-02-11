<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

class ExceptionHandler implements ExceptionHandlerInterface
{
    use Logger\AwareTrait;

    public function __invoke(\Throwable $throwable): void
    {
        if (getenv('DEBUG_MODE') === 'true') {
            // open the stream just in case is not defined
            $stderr = fopen('php://stderr', 'wb');
            fwrite($stderr, $throwable->__toString() . PHP_EOL);
        }

        if (getenv('SITE_ENVIRONMENT') === 'Local') {
            // Writing to file is extremely slow and should never be done on Production from an HTTP context
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
