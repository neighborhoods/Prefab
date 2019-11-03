<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteriaInterface;

interface BuilderInterface
{
    public const DIRECTION = 'direction';
    public const PAGE_SIZE = 'pageSize';
    public const CONDITION = 'condition';
    public const CURRENT_PAGE = 'currentPage';
    public const GLUE = 'glue';
    public const VALUES = 'values';
    public const FILTERS = 'filters';
    public const FIELD = 'field';
    public const SEARCH_CRITERIA = 'searchCriteria';
    public const SORT_ORDER = 'sortOrder';

    public function build(): SearchCriteriaInterface;

    public function setRecord(array $record) : BuilderInterface;
}
