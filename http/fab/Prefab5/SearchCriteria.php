<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\FilterInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\SortOrder;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Filter;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Visitor;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\SortOrderInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\VisitorInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder;

class SearchCriteria implements SearchCriteriaInterface
{
    use Filter\Map\Factory\AwareTrait;
    use SortOrder\Map\Factory\AwareTrait;
    use Visitor\Map\Factory\AwareTrait;
    use QueryBuilder\Visitor\Factory\AwareTrait;

    private const QUERY_STRING_PARAM_SEPARATOR = '&';

    /** @var Filter\MapInterface */
    protected $filters;
    /** @var SortOrder\MapInterface */
    protected $sortOrders;
    /** @var Visitor\MapInterface */
    protected $visitors;
    /** @var int */
    protected $pageSize;
    /** @var int */
    protected $currentPage;

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function addFilter(FilterInterface $filter): SearchCriteriaInterface
    {
        foreach ($this->getVisitors() as $visitor) {
            $visitor->addFilter($filter);
        }
        $this->getFilters()[] = $filter;

        return $this;
    }

    public function getFilters(): Filter\MapInterface
    {
        if ($this->filters === null) {
            $this->filters = $this->getSearchCriteriaFilterMapFactory()->create();
        }
        return $this->filters;
    }

    public function hasFilters(): bool
    {
        return $this->filters !== null;
    }

    public function getSortOrders(): SortOrder\MapInterface
    {
        if ($this->sortOrders === null) {
            $this->sortOrders = $this->getSearchCriteriaSortOrderMapFactory()->create();
        }
        return $this->sortOrders;
    }

    public function addSortOrder(SortOrderInterface $sortOrder): SearchCriteriaInterface
    {
        foreach ($this->getVisitors() as $visitor) {
            $visitor->addSortOrder($sortOrder);
        }
        $this->getSortOrders()[] = $sortOrder;

        return $this;
    }

    public function hasSortOrders(): bool
    {
        return $this->sortOrders !== null;
    }

    protected function getVisitors() : Visitor\MapInterface
    {
        if ($this->visitors === null) {
            $this->visitors = $this->getSearchCriteriaVisitorMapFactory()->create();
            $doctrineQueryBuilderVisitor = $this->getSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory()->create();
            $this->addVisitor($doctrineQueryBuilderVisitor);
        }
        return $this->visitors;
    }

    public function addVisitor(VisitorInterface $visitor): SearchCriteriaInterface
    {
        $this->getVisitors()[get_class($visitor) . 'Interface'] = $visitor;

        return $this;
    }

    public function getVisitor(string $identity): VisitorInterface
    {
        if (!isset($this->getVisitors()[$identity])) {
            throw new \LogicException("Visitor with identity[$identity] is not set.");
        }

        return $this->getVisitors()[$identity];
    }

    public function getPageSize(): int
    {
        if ($this->pageSize === null) {
            throw new \LogicException('SearchCriteria pageSize has not been set.');
        }

        return $this->pageSize;
    }

    public function setPageSize(int $pageSize): SearchCriteriaInterface
    {
        if ($this->pageSize !== null) {
            throw new \LogicException('SearchCriteria pageSize is already set.');
        }
        foreach ($this->getVisitors() as $visitor) {
            $visitor->setPageSize($pageSize);
        }
        $this->pageSize = $pageSize;

        return $this;
    }

    public function hasPageSize(): bool
    {
        return $this->pageSize !== null;
    }

    public function getCurrentPage(): int
    {
        if ($this->currentPage === null) {
            throw new \LogicException('SearchCriteria currentPage has not been set.');
        }

        return $this->currentPage;
    }

    public function setCurrentPage(int $currentPage): SearchCriteriaInterface
    {
        if ($this->currentPage !== null) {
            throw new \LogicException('SearchCriteria currentPage is already set.');
        }
        foreach ($this->getVisitors() as $visitor) {
            $visitor->setCurrentPage($currentPage);
        }
        $this->currentPage = $currentPage;

        return $this;
    }

    public function hasCurrentPage(): bool
    {
        return $this->currentPage !== null;
    }

    public function toQueryString() : string
    {
        $filters = $this->filtersToQueryString();
        $sorts = $this->sortsToQueryString();
        $pageSize = $this->pageSizeToQueryString();
        $currentPage = $this->currentPageToQueryString();

        $queryString = '?' . $filters
            . (($sorts) ? self::QUERY_STRING_PARAM_SEPARATOR . $sorts : '')
            . (($pageSize) ? self::QUERY_STRING_PARAM_SEPARATOR . $pageSize : '')
            . (($currentPage) ? self::QUERY_STRING_PARAM_SEPARATOR . $currentPage : '');

        return $queryString;
    }

    protected function filtersToQueryString(): string
    {
        if(!$this->hasFilters()) {
            return '';
        }

        $queryStringFilters = [];
        foreach ($this->getFilters() as $i => $filter) {
            $glue = sprintf('searchCriteria[filters][%s][glue]=%s', $i, $filter->getGlue());
            $field = sprintf('searchCriteria[filters][%s][field]=%s', $i, $filter->getField());
            $condition = sprintf('searchCriteria[filters][%s][condition]=%s', $i, $filter->getCondition());
            $values = [];
            foreach ($filter->getValues() as $j => $value) {
                $values[] = sprintf('searchCriteria[filters][%s][values][%s]=%s', $i, $j, $value);
            }

            $queryStringFilter = $glue
                . self::QUERY_STRING_PARAM_SEPARATOR . $field
                . self::QUERY_STRING_PARAM_SEPARATOR . $condition
                . self::QUERY_STRING_PARAM_SEPARATOR . implode(self::QUERY_STRING_PARAM_SEPARATOR, $values);

            $queryStringFilters[] = $queryStringFilter;
        }

        return implode(self::QUERY_STRING_PARAM_SEPARATOR, $queryStringFilters);
    }

    protected function sortsToQueryString(): string
    {
        if(!$this->hasSortOrders()) {
            return '';
        }

        $queryStringSorts = [];
        foreach ($this->getSortOrders() as $i => $sort) {
            $field = sprintf('searchCriteria[sortOrder][%s][field]=%s', $i, $sort->getField());
            $direction = sprintf('searchCriteria[sortOrder][%s][direction]=%s', $i, $sort->getDirection());

            $queryStringSorts[] = $field . self::QUERY_STRING_PARAM_SEPARATOR . $direction;
        }

        return implode(self::QUERY_STRING_PARAM_SEPARATOR, $queryStringSorts);
    }

    protected function pageSizeToQueryString(): string
    {
        return $this->hasPageSize() ? sprintf('searchCriteria[pageSize]=%s', $this->getPageSize()) : '';
    }

    protected function currentPageToQueryString(): string
    {
        return $this->hasCurrentPage() ? sprintf('searchCriteria[currentPage]=%s', $this->getCurrentPage()) : '';
    }
}
