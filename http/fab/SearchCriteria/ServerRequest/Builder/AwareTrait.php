<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria\ServerRequest\Builder;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteria\ServerRequest\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilder;

    public function setSearchCriteriaServerRequestBuilder(BuilderInterface $searchCriteriaServerRequestBuilder): self
    {
        if ($this->hasSearchCriteriaServerRequestBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilder is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilder = $searchCriteriaServerRequestBuilder;

        return $this;
    }

    protected function getSearchCriteriaServerRequestBuilder(): BuilderInterface
    {
        if (!$this->hasSearchCriteriaServerRequestBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilder is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilder;
    }

    protected function hasSearchCriteriaServerRequestBuilder(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilder);
    }

    protected function unsetSearchCriteriaServerRequestBuilder(): self
    {
        if (!$this->hasSearchCriteriaServerRequestBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilder is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41SearchCriteriaServerRequestBuilder);

        return $this;
    }
}
