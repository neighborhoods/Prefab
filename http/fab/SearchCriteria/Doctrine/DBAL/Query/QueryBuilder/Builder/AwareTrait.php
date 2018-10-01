<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder;

    public function setSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder(
        BuilderInterface $searchCriteriaDoctrineDBALQueryQueryBuilderBuilder
    ): self {
        if ($this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder = $searchCriteriaDoctrineDBALQueryQueryBuilderBuilder;

        return $this;
    }

    protected function getSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder(): BuilderInterface
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder;
    }

    protected function hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder);
    }

    protected function unsetSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder(): self
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder);

        return $this;
    }
}
