<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): SortOrderInterface
    {
        return clone $this->getSearchCriteriaSortOrder();
    }
}
