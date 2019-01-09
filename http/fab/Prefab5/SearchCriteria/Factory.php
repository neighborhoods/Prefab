<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteriaInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): SearchCriteriaInterface
    {
        return clone $this->getSearchCriteria();
    }
}
