<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder;

use Doctrine\DBAL\Query\QueryBuilder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteriaInterface;

interface BuilderInterface
{
    public function build(): QueryBuilder;

    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria);
}
