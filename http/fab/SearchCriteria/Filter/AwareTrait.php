<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Filter;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteria\FilterInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilter;

    public function setSearchCriteriaFilter(FilterInterface $searchCriteriaFilter): self
    {
        if ($this->hasSearchCriteriaFilter()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilter is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilter = $searchCriteriaFilter;

        return $this;
    }

    protected function getSearchCriteriaFilter(): FilterInterface
    {
        if (!$this->hasSearchCriteriaFilter()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilter is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilter;
    }

    protected function hasSearchCriteriaFilter(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilter);
    }

    protected function unsetSearchCriteriaFilter(): self
    {
        if (!$this->hasSearchCriteriaFilter()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilter is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilter);

        return $this;
    }
}
