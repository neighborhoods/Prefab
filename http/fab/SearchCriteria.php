<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\FilterInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Filter;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Visitor;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrderInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\VisitorInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder;

class SearchCriteria implements SearchCriteriaInterface
{
    use Filter\Map\Factory\AwareTrait;
    use SortOrder\Map\Factory\AwareTrait;
    use Visitor\Map\Factory\AwareTrait;
    use QueryBuilder\Visitor\Factory\AwareTrait;

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
}
