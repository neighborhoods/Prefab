<?php

declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteriaInterface;

class Validator implements ValidatorInterface
{
    public function validate(SearchCriteriaInterface $searchCriteria): ValidatorInterface
    {
        try {
            throw (new ValidationException())->addMessage('No validators approved this request.');
        } catch (ValidationException $exception) { // @deprecated the try/catch will be removed in a future major version upgrade
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
