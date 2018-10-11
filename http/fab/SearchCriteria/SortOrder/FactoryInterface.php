<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): SortOrderInterface;
}
