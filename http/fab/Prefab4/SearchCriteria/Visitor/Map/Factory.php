<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\SearchCriteria\Visitor\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\SearchCriteria\Visitor\MapInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getSearchCriteriaVisitorMap()->getArrayCopy();
    }
}
