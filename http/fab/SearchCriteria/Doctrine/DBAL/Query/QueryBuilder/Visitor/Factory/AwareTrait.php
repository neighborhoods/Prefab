<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Visitor\Factory;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Visitor\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory;

    public function setSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory(
        FactoryInterface $searchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory
    ): self {
        if ($this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory = $searchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory;

        return $this;
    }

    protected function getSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory;
    }

    protected function hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory);
    }

    protected function unsetSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory(): self
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory);

        return $this;
    }
}
