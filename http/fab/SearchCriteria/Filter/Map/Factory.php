<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Filter\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Filter\MapInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getSearchCriteriaFilterMap()->getArrayCopy();
    }
}
