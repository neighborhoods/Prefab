<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Visitor\Map;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Visitor\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41SearchCriteriaVisitorMap;

    public function setSearchCriteriaVisitorMap(MapInterface $searchCriteriaVisitorMap): self
    {
        if ($this->hasSearchCriteriaVisitorMap()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaVisitorMap is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaVisitorMap = $searchCriteriaVisitorMap;

        return $this;
    }

    protected function getSearchCriteriaVisitorMap(): MapInterface
    {
        if (!$this->hasSearchCriteriaVisitorMap()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaVisitorMap is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaVisitorMap;
    }

    protected function hasSearchCriteriaVisitorMap(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaVisitorMap);
    }

    protected function unsetSearchCriteriaVisitorMap(): self
    {
        if (!$this->hasSearchCriteriaVisitorMap()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaVisitorMap is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaVisitorMap);

        return $this;
    }
}
