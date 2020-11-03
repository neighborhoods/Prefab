<?php

declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteriaInterface;

class Validator implements ValidatorInterface
{
    public function validate(SearchCriteriaInterface $searchCriteria): ValidatorInterface
    {
        // @todo include request?
        throw (new ValidationException())->addMessage('No validators approved this request.');
    }
}
