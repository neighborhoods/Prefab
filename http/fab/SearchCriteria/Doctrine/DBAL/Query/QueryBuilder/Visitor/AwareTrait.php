<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Visitor;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\VisitorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitor;

    public function setSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor(
        VisitorInterface $searchCriteriaDoctrineDBALQueryQueryBuilderVisitor
    ): self {
        if ($this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitor is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitor = $searchCriteriaDoctrineDBALQueryQueryBuilderVisitor;

        return $this;
    }

    protected function getSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor(): VisitorInterface
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitor is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitor;
    }

    protected function hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitor);
    }

    protected function unsetSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor(): self
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitor is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaDoctrineDBALQueryQueryBuilderVisitor);

        return $this;
    }
}
