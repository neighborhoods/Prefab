<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Filter;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\FilterInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): FilterInterface
    {
        return clone $this->getSearchCriteriaFilter();
    }
}
