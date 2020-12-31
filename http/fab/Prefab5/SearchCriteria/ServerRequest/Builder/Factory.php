<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\ServerRequest\Builder;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\ServerRequest\BuilderInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;
    use SearchCriteria\Validator\Builder\Factory\AwareTrait;

    public function create(): BuilderInterface
    {
        $searchCriteriaServerRequestBuilder = clone $this->getSearchCriteriaServerRequestBuilder();
        $searchCriteriaServerRequestBuilder->setValidatorBuilderFactory($this->getValidatorBuilderFactory());
        return $searchCriteriaServerRequestBuilder;
    }
}
