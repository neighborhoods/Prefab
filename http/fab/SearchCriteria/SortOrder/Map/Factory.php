<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder\MapInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getSearchCriteriaSortOrderMap()->getArrayCopy();
    }
}
