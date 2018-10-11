<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilder;

    public function setSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder(
        BuilderInterface $searchCriteriaDoctrineDBALQueryQueryBuilderBuilder
    ): self {
        if ($this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilder is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilder = $searchCriteriaDoctrineDBALQueryQueryBuilderBuilder;

        return $this;
    }

    protected function getSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder(): BuilderInterface
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilder is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilder;
    }

    protected function hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilder);
    }

    protected function unsetSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder(): self
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilder is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilder);

        return $this;
    }
}
