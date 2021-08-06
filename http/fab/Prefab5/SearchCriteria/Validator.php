<?php

declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Logger;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteriaInterface;

class Validator implements ValidatorInterface
{
    public function validate(SearchCriteriaInterface $searchCriteria): ValidatorInterface
    {
        try {
            throw (new ValidationException())->addMessage('No validators approved this request.');
        } catch (ValidationException $exception) { // @deprecated the try/catch will be removed in a future major version upgrade
            if (getenv('DEBUG_MODE') === 'true') {
                if (defined('STDERR')) {
                    // Should exist from a CLI context
                    fwrite(STDERR, $exception->__toString() . PHP_EOL);
                }
                (new Logger())
                    ->setLogFilePath(__DIR__ . '/../../Logs/HTTP.log')
                    ->critical($exception->__toString() . PHP_EOL);
            }

            $repository = new \Neighborhoods\DatadogComponent\GlobalTracer\Repository();
            $tracer = $repository->get();
            $span = $tracer->getActiveSpan();
            if ($span !== null) {
                $span->setError($exception);
            }
            return $this;
        }
    }
}
