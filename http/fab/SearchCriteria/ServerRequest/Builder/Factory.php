<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\ServerRequest\Builder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\ServerRequest\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getSearchCriteriaServerRequestBuilder();
    }
}
