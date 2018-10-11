<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Visitor;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\VisitorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): VisitorInterface;
}
