<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder;

use Doctrine\DBAL\Query\QueryBuilder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteriaInterface;

interface BuilderInterface
{
    public function build(): QueryBuilder;

    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria);
}