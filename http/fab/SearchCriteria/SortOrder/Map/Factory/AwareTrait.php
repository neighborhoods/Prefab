<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria\SortOrder\Map\Factory;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteria\SortOrder\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMapFactory;

    public function setSearchCriteriaSortOrderMapFactory(FactoryInterface $searchCriteriaSortOrderMapFactory): self
    {
        if ($this->hasSearchCriteriaSortOrderMapFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMapFactory is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMapFactory = $searchCriteriaSortOrderMapFactory;

        return $this;
    }

    protected function getSearchCriteriaSortOrderMapFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaSortOrderMapFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMapFactory is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMapFactory;
    }

    protected function hasSearchCriteriaSortOrderMapFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMapFactory);
    }

    protected function unsetSearchCriteriaSortOrderMapFactory(): self
    {
        if (!$this->hasSearchCriteriaSortOrderMapFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMapFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMapFactory);

        return $this;
    }
}
