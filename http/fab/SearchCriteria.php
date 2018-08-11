<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\FilterInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Filter;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Visitor;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrderInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\VisitorInterface;

class SearchCriteria implements SearchCriteriaInterface
{
    use Filter\Map\AwareTrait;
    use SortOrder\Map\AwareTrait;
    use Visitor\Map\AwareTrait;
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
        foreach ($this->getSearchCriteriaVisitorMap() as $visitor) {
            $visitor->addFilter($filter);
        }
        $this->getSearchCriteriaFilterMap()[] = $filter;

        return $this;
    }

    public function getFilters(): Filter\MapInterface
    {
        return $this->getSearchCriteriaFilterMap();
    }

    public function getSortOrders(): SortOrder\MapInterface
    {
        return $this->getSearchCriteriaSortOrderMap();
    }

    public function addSortOrder(SortOrderInterface $sortOrder): SearchCriteriaInterface
    {
        foreach ($this->getSearchCriteriaVisitorMap() as $visitor) {
            $visitor->addSortOrder($sortOrder);
        }
        $this->getSearchCriteriaSortOrderMap()[] = $sortOrder;

        return $this;
    }

    public function addVisitor(VisitorInterface $visitor): SearchCriteriaInterface
    {
        $this->getSearchCriteriaVisitorMap()[get_class($visitor) . 'Interface'] = $visitor;

        return $this;
    }

    public function getVisitor(string $identity): VisitorInterface
    {
        if (!isset($this->getSearchCriteriaVisitorMap()[$identity])) {
            throw new \LogicException("Visitor with identity[$identity] is not set.");
        }

        return $this->getSearchCriteriaVisitorMap()[$identity];
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
        foreach ($this->getSearchCriteriaVisitorMap() as $visitor) {
            $visitor->setPageSize($pageSize);
        }
        if ($this->pageSize !== null) {
            throw new \LogicException('SearchCriteria pageSize is already set.');
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
        foreach ($this->getSearchCriteriaVisitorMap() as $visitor) {
            $visitor->setCurrentPage($currentPage);
        }
        if ($this->currentPage !== null) {
            throw new \LogicException('SearchCriteria currentPage is already set.');
        }
        $this->currentPage = $currentPage;

        return $this;
    }
}