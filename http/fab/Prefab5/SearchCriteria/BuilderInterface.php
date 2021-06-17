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
    public const CONDITIONS_WITH_MULTIPLE_VALUES = [
        'in',
        'nin',
        'contains',
        'overlaps',
    ];
    public const CONDITIONS_WITH_SINGLE_VALUE = [
        'eq',
        'neq',
        'lt',
        'lte',
        'gt',
        'gte',
        'like',
        'nlike',
        'st_contains',
        'jsonb_key_exist',
    ];
    public const CONDITIONS_WITHOUT_VALUE = [
        'is_null',
        'is_not_null',
    ];
    public const CONDITIONS_WITH_CENTER_AND_RADIUS = [
        'st_dwithin',
        'st_within',
    ];

    public function build(): SearchCriteriaInterface;

    public function setRecord(array $record) : BuilderInterface;
}
