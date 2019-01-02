<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Filter;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\FilterInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\SortOrder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\SortOrderInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\VisitorInterface;

interface SearchCriteriaInterface extends \JsonSerializable
{
    public function addFilter(FilterInterface $filter): SearchCriteriaInterface;

    public function getFilters(): Filter\MapInterface;

    public function getSortOrders(): SortOrder\MapInterface;

    public function addSortOrder(SortOrderInterface $sortOrder): SearchCriteriaInterface;

    public function getPageSize(): int;

    public function setPageSize(int $pageSize): SearchCriteriaInterface;

    public function getCurrentPage(): int;

    public function setCurrentPage(int $currentPage): SearchCriteriaInterface;

    public function addVisitor(VisitorInterface $visitor): SearchCriteriaInterface;

    public function getVisitor(string $identity): VisitorInterface;
}
