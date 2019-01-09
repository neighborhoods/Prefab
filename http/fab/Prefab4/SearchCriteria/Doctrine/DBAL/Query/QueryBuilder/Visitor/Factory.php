<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Visitor;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\VisitorInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): VisitorInterface
    {
        return clone $this->getSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor();
    }
}
