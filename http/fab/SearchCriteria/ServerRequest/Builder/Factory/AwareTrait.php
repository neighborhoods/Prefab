<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria\ServerRequest\Builder\Factory;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteria\ServerRequest\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilderFactory;

    public function setSearchCriteriaServerRequestBuilderFactory(
        FactoryInterface $searchCriteriaServerRequestBuilderFactory
    ): self {
        if ($this->hasSearchCriteriaServerRequestBuilderFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilderFactory is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilderFactory = $searchCriteriaServerRequestBuilderFactory;

        return $this;
    }

    protected function getSearchCriteriaServerRequestBuilderFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaServerRequestBuilderFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilderFactory is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilderFactory;
    }

    protected function hasSearchCriteriaServerRequestBuilderFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilderFactory);
    }

    protected function unsetSearchCriteriaServerRequestBuilderFactory(): self
    {
        if (!$this->hasSearchCriteriaServerRequestBuilderFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilderFactory);

        return $this;
    }
}
