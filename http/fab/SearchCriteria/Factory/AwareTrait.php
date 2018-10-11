<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Factory;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteria\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41SearchCriteriaFactory;

    public function setSearchCriteriaFactory(FactoryInterface $searchCriteriaFactory): self
    {
        if ($this->hasSearchCriteriaFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaFactory is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFactory = $searchCriteriaFactory;

        return $this;
    }

    protected function getSearchCriteriaFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaFactory is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFactory;
    }

    protected function hasSearchCriteriaFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFactory);
    }

    protected function unsetSearchCriteriaFactory(): self
    {
        if (!$this->hasSearchCriteriaFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFactory);

        return $this;
    }
}
