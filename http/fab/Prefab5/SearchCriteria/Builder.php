<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteriaInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Psr;

class Builder implements BuilderInterface
{
    use SearchCriteria\Filter\Factory\AwareTrait;
    use SearchCriteria\SortOrder\Factory\AwareTrait;
    use SearchCriteria\Factory\AwareTrait;
    use Psr\Http\Message\ServerRequest\AwareTrait;

    protected $searchCriteriaQuery;
    protected $record;

    public function build(): SearchCriteriaInterface
    {
        $searchCriteria = $this->getSearchCriteriaFactory()->create();
        $this->hydrateFields($searchCriteria);
        $this->hydrateSortOrder($searchCriteria);
        $this->hydratePageSize($searchCriteria);
        $this->hydrateCurrentPage($searchCriteria);

        return $searchCriteria;
    }

    protected function getRecord(): array
    {
        if ($this->record === null) {
            throw new \LogicException('Builder record has not been set.');
        }

        return $this->record;
    }

    public function setRecord(array $record): BuilderInterface
    {
        if ($this->record !== null) {
            throw new \LogicException('Builder record is already set.');
        }

        $this->record = $record;

        return $this;
    }

    protected function cast(string $string)
    {
        if (
            $string[0] !== '0'
            && is_numeric($string)
            && (int)$string < PHP_INT_MAX
        ) {
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
        $record = $this->getRecord();
        if (isset($record[self::FILTERS]) && is_array($record[self::FILTERS])) {
            foreach ($record[self::FILTERS] as $filterQuery) {
                if ($this->assertValidFilterQuery($filterQuery)) {
                    $filter = $this->getSearchCriteriaFilterFactory()->create();
                    $filter->setField($filterQuery[self::FIELD]);
                    $value = $filterQuery[self::VALUES];
                    if (is_array($value)) {
                        $values = [];
                        foreach ($value as $key => $valueItem) {
                            $values[$key] = $this->cast($valueItem);
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
        $record = $this->getRecord();
        if (isset($record[self::SORT_ORDER]) && is_array($record[self::SORT_ORDER])) {
            foreach ($record[self::SORT_ORDER] as $sortOrderQuery) {
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
        $record = $this->getRecord();
        if (isset($record[self::PAGE_SIZE])) {
            $pageSize = $record[self::PAGE_SIZE];
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
        $record = $this->getRecord();
        if (isset($record[self::CURRENT_PAGE])) {
            $pageSize = $record[self::CURRENT_PAGE];
            if (ctype_digit($pageSize)) {
                $searchCriteria->setCurrentPage((int)$pageSize);
            } else {
                throw new \LogicException('Current page is not an integer.');
            }
        }

        return $this;
    }
}
