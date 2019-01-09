<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder;

use Doctrine\DBAL\Query\QueryBuilder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;

interface VisitorInterface extends SearchCriteria\VisitorInterface
{
    public function getQueryBuilder(): QueryBuilder;
}
