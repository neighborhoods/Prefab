<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria\SortOrder\Map;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteria\SortOrder\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMap;

    public function setSearchCriteriaSortOrderMap(MapInterface $searchCriteriaSortOrderMap): self
    {
        if ($this->hasSearchCriteriaSortOrderMap()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMap is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMap = $searchCriteriaSortOrderMap;

        return $this;
    }

    protected function getSearchCriteriaSortOrderMap(): MapInterface
    {
        if (!$this->hasSearchCriteriaSortOrderMap()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMap is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMap;
    }

    protected function hasSearchCriteriaSortOrderMap(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMap);
    }

    protected function unsetSearchCriteriaSortOrderMap(): self
    {
        if (!$this->hasSearchCriteriaSortOrderMap()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMap is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrderMap);

        return $this;
    }
}
