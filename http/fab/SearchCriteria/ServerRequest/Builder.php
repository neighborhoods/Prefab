<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\ServerRequest;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteriaInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Psr;

class Builder implements BuilderInterface
{
    use ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Filter\Factory\AwareTrait;
    use ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder\Factory\AwareTrait;
    use ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Factory\AwareTrait;
    use Psr\Http\Message\ServerRequest\AwareTrait;

    protected $searchCriteriaQuery;

    public function build(): SearchCriteriaInterface
    {
        $searchCriteria = $this->getSearchCriteriaFactory()->create();
        $this->hydrateFields($searchCriteria);
        $this->hydrateSortOrder($searchCriteria);
        $this->hydratePageSize($searchCriteria);
        $this->hydrateCurrentPage($searchCriteria);

        return $searchCriteria;
    }

    protected function getSearchCriteriaQuery(): array
    {
        if ($this->searchCriteriaQuery === null) {
            $queryParams = $this->getPsrHttpMessageServerRequest()->getQueryParams();
            if (isset($queryParams[self::SEARCH_CRITERIA]) && is_array($queryParams[self::SEARCH_CRITERIA])) {
                $searchCriteriaQuery = $queryParams[self::SEARCH_CRITERIA];
            } else {
                throw new \LogicException('Search criteria query parameter key is not set.');
            }
            $this->searchCriteriaQuery = $searchCriteriaQuery;
        }

        return $this->searchCriteriaQuery;
    }

    protected function cast(string $string)
    {
        if (is_numeric($string) && (int)$string < PHP_INT_MAX) {
            if (ctype_digit($string)) {
                return (int)$string;
            } else {
                return (float)$string;
            }
        }

        return $string;
    }

    protected function assertValidFilterQuery(array $filterQuery): BuilderInterface
    {
        $requiredFilterProperties = [
            self::FIELD,
            self::VALUES,
            self::CONDITION,
            self::GLUE,
        ];
        $missingRequiredFilterProperties = [];

        foreach ($requiredFilterProperties as $requiredFilterProperty) {
            if (!isset($filterQuery[$requiredFilterProperty])) {
                $missingRequiredFilterProperties[] = $requiredFilterProperty;
            }
        }

        if (!empty($missingRequiredFilterProperties)) {
            throw new \LogicException('Filter property not set: ' . implode(', ', $missingRequiredFilterProperties));
        }

        return $this;
    }

    protected function hydrateFields(SearchCriteriaInterface $searchCriteria): BuilderInterface
    {
        $searchCriteriaQuery = $this->getSearchCriteriaQuery();
        if (isset($searchCriteriaQuery[self::FILTERS]) && is_array($searchCriteriaQuery[self::FILTERS])) {
            foreach ($searchCriteriaQuery[self::FILTERS] as $filterQuery) {
                if ($this->assertValidFilterQuery($filterQuery)) {
                    $filter = $this->getSearchCriteriaFilterFactory()->create();
                    $filter->setField($filterQuery[self::FIELD]);
                    $value = $filterQuery[self::VALUES];
                    if (is_array($value)) {
                        $values = [];
                        foreach ($value as $valueItem) {
                            $values[] = $this->cast($valueItem);
                        }
                        $filter->setValues($values);
                    } else {
                        $filter->setValues([$this->cast($value)]);
                    }
                    $filter->setCondition($filterQuery[self::CONDITION]);
                    $filter->setGlue($filterQuery[self::GLUE]);
                    $searchCriteria->addFilter($filter);
                }
            }
        }

        return $this;
    }

    protected function hydrateSortOrder(SearchCriteriaInterface $searchCriteria): BuilderInterface
    {
        $searchCriteriaQuery = $this->getSearchCriteriaQuery();
        if (isset($searchCriteriaQuery[self::SORT_ORDER]) && is_array($searchCriteriaQuery[self::SORT_ORDER])) {
            foreach ($searchCriteriaQuery[self::SORT_ORDER] as $sortOrderQuery) {
                if (isset($sortOrderQuery[self::FIELD]) && isset($sortOrderQuery[self::DIRECTION])) {
                    $sortOrder = $this->getSearchCriteriaSortOrderFactory()->create();
                    $sortOrder->setField($sortOrderQuery[self::FIELD]);
                    $sortOrder->setDirection($sortOrderQuery[self::DIRECTION]);
                    $searchCriteria->addSortOrder($sortOrder);
                } else {
                    throw new \LogicException('A sort order property is not set.');
                }
            }
        }

        return $this;
    }

    protected function hydratePageSize(SearchCriteriaInterface $searchCriteria): BuilderInterface
    {
        $searchCriteriaQuery = $this->getSearchCriteriaQuery();
        if (isset($searchCriteriaQuery[self::PAGE_SIZE])) {
            $pageSize = $searchCriteriaQuery[self::PAGE_SIZE];
            if (ctype_digit($pageSize)) {
                $searchCriteria->setPageSize((int)$pageSize);
            } else {
                throw new \LogicException('Page size is not an integer.');
            }
        }

        return $this;
    }

    protected function hydrateCurrentPage(SearchCriteriaInterface $searchCriteria): BuilderInterface
    {
        $searchCriteriaQuery = $this->getSearchCriteriaQuery();
        if (isset($searchCriteriaQuery[self::CURRENT_PAGE])) {
            $pageSize = $searchCriteriaQuery[self::CURRENT_PAGE];
            if (ctype_digit($pageSize)) {
                $searchCriteria->setCurrentPage((int)$pageSize);
            } else {
                throw new \LogicException('Current page is not an integer.');
            }
        }

        return $this;
    }
}
