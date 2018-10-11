<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Filter\Factory;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteria\Filter\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterFactory;

    public function setSearchCriteriaFilterFactory(FactoryInterface $searchCriteriaFilterFactory): self
    {
        if ($this->hasSearchCriteriaFilterFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterFactory is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterFactory = $searchCriteriaFilterFactory;

        return $this;
    }

    protected function getSearchCriteriaFilterFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaFilterFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterFactory is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterFactory;
    }

    protected function hasSearchCriteriaFilterFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterFactory);
    }

    protected function unsetSearchCriteriaFilterFactory(): self
    {
        if (!$this->hasSearchCriteriaFilterFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaFilterFactory);

        return $this;
    }
}
