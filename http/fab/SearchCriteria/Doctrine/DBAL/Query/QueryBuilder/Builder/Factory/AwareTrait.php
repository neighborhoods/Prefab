<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory;

    public function setSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory(
        FactoryInterface $searchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory
    ): self {
        if ($this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory = $searchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory;

        return $this;
    }

    protected function getSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory;
    }

    protected function hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory);
    }

    protected function unsetSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory(): self
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory);

        return $this;
    }
}
