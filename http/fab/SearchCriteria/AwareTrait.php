<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteriaInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41SearchCriteria;

    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria): self
    {
        if ($this->hasSearchCriteria()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteria is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41SearchCriteria = $searchCriteria;

        return $this;
    }

    protected function getSearchCriteria(): SearchCriteriaInterface
    {
        if (!$this->hasSearchCriteria()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteria is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41SearchCriteria;
    }

    protected function hasSearchCriteria(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteria);
    }

    protected function unsetSearchCriteria(): self
    {
        if (!$this->hasSearchCriteria()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteria is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteria);

        return $this;
    }
}
