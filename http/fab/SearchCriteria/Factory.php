<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteriaInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): SearchCriteriaInterface
    {
        return clone $this->getSearchCriteria();
    }
}
