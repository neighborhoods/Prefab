<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteriaInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): SearchCriteriaInterface;
}
