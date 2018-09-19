<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\ServerRequest;

use Psr\Http\Message\ServerRequestInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria;

interface BuilderInterface extends SearchCriteria\BuilderInterface
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

    public function setPsrHttpMessageServerRequest(ServerRequestInterface $psrHttpMessageServerRequest);
}
