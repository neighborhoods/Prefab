<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder\Factory;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory;

    public function setSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory(
        FactoryInterface $searchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory
    ): self {
        if ($this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory = $searchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory;

        return $this;
    }

    protected function getSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory;
    }

    protected function hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory);
    }

    protected function unsetSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory(): self
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory);

        return $this;
    }
}
