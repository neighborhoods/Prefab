<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\SearchCriteria\SortOrder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\SearchCriteria\SortOrderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): SortOrderInterface;
}
