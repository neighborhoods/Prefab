<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Doctrine;
use Doctrine\DBAL\Query\QueryBuilder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria;

class Builder implements BuilderInterface
{
    use SearchCriteria\AwareTrait;

    public function build(): QueryBuilder
    {
        $queryBuilder = clone $this->getQueryBuilderVisitor()->getQueryBuilder();

        return $queryBuilder;
    }

    protected function getQueryBuilderVisitor(): VisitorInterface
    {
        $visitor = $this->getSearchCriteria()->getVisitor(VisitorInterface::class);
        if (!($visitor instanceof VisitorInterface)) {
            throw new \UnexpectedValueException('Visitor is not an instanceof[' . VisitorInterface::class . ']');
        }

        return $visitor;
    }
}