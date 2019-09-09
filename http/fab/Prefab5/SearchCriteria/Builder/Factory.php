<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Builder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getSearchCriteriaBuilder();
    }
}
