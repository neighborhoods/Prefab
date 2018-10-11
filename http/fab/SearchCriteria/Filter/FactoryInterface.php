<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Filter;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\FilterInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): FilterInterface;
}
