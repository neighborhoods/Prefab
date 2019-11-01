<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\ServerRequest;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteriaInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Psr;

class Builder implements BuilderInterface
{
    use SearchCriteria\Filter\Factory\AwareTrait;
    use SearchCriteria\SortOrder\Factory\AwareTrait;
    use SearchCriteria\Factory\AwareTrait;
    use Psr\Http\Message\ServerRequest\AwareTrait;
    use SearchCriteria\Builder\Factory\AwareTrait;

    protected $searchCriteriaQuery;

    public function build(): SearchCriteriaInterface
    {
        return $this->getSearchCriteriaBuilderFactory()->create()
            ->setRecord($this->getSearchCriteriaQuery())
            ->build();
    }

    protected function getSearchCriteriaQuery(): array
    {
        if ($this->searchCriteriaQuery === null) {
            if ($this->getPsrHttpMessageServerRequest()->getMethod() === 'POST') {
                $queryParams = $this->getPsrHttpMessageServerRequest()->getParsedBody();
            } else {
                $queryParams = $this->getPsrHttpMessageServerRequest()->getQueryParams();
            }
            if (isset($queryParams[self::SEARCH_CRITERIA]) && is_array($queryParams[self::SEARCH_CRITERIA])) {
                $searchCriteriaQuery = $queryParams[self::SEARCH_CRITERIA];
            } else {
                throw new \LogicException('Search criteria query parameter key is not set.');
            }
            $this->searchCriteriaQuery = $searchCriteriaQuery;
        }

        return $this->searchCriteriaQuery;
    }
}
