<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Visitor\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Visitor\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory;

    public function setSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory(
        FactoryInterface $searchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory
    ): self {
        if ($this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory = $searchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory;

        return $this;
    }

    protected function getSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory;
    }

    protected function hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory);
    }

    protected function unsetSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory(): self
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory);

        return $this;
    }
}
