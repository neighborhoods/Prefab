<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria\SortOrder;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteria\SortOrderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrder;

    public function setSearchCriteriaSortOrder(SortOrderInterface $searchCriteriaSortOrder): self
    {
        if ($this->hasSearchCriteriaSortOrder()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrder is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrder = $searchCriteriaSortOrder;

        return $this;
    }

    protected function getSearchCriteriaSortOrder(): SortOrderInterface
    {
        if (!$this->hasSearchCriteriaSortOrder()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrder is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrder;
    }

    protected function hasSearchCriteriaSortOrder(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrder);
    }

    protected function unsetSearchCriteriaSortOrder(): self
    {
        if (!$this->hasSearchCriteriaSortOrder()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrder is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaSortOrder);

        return $this;
    }
}
