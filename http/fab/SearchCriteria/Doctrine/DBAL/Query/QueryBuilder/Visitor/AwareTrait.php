<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Visitor;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\VisitorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor;

    public function setSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor(
        VisitorInterface $searchCriteriaDoctrineDBALQueryQueryBuilderVisitor
    ): self {
        if ($this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor = $searchCriteriaDoctrineDBALQueryQueryBuilderVisitor;

        return $this;
    }

    protected function getSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor(): VisitorInterface
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor;
    }

    protected function hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor);
    }

    protected function unsetSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor(): self
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor);

        return $this;
    }
}
