<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Filter\Map;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Filter\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterMap;

    public function setSearchCriteriaFilterMap(MapInterface $searchCriteriaFilterMap): self
    {
        if ($this->hasSearchCriteriaFilterMap()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterMap is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterMap = $searchCriteriaFilterMap;

        return $this;
    }

    protected function getSearchCriteriaFilterMap(): MapInterface
    {
        if (!$this->hasSearchCriteriaFilterMap()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterMap is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterMap;
    }

    protected function hasSearchCriteriaFilterMap(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterMap);
    }

    protected function unsetSearchCriteriaFilterMap(): self
    {
        if (!$this->hasSearchCriteriaFilterMap()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterMap is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterMap);

        return $this;
    }
}
