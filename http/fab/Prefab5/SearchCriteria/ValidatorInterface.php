<?php

declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteriaInterface;

interface ValidatorInterface
{
    public function validate(SearchCriteriaInterface $searchCriteria): ValidatorInterface;
}
