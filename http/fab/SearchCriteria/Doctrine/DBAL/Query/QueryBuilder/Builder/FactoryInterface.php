<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): BuilderInterface;
}
