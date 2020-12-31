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
        } catch (ValidationException $e) { // @deprecated the try/catch will be removed in the next major version upgrade
            // @todo dd notice error
            return $this;
        }
    }
}
