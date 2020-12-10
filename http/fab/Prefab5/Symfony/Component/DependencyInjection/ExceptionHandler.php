<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Symfony\Component\DependencyInjection;

/**
 * @deprecated
 * @see \ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\ExceptionHandler
 */
class ExceptionHandler implements ExceptionHandlerInterface
{
    public function __invoke(\Throwable $throwable): ExceptionHandlerInterface
    {
        $repository = new \Neighborhoods\DatadogComponent\GlobalTracer\Repository();
        $tracer = $repository->get();
        $span = $tracer->getActiveSpan();
        if ($span !== null) {
            $span->setError($throwable);
        }

        if (defined('STDERR')) {
            // Should exist from a CLI context
            fwrite(STDERR, $throwable->__toString() . PHP_EOL);
        }

        return $this;
    }
}
