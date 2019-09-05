<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Builder\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory;

    public function setSearchCriteriaBuilderFactory(
        FactoryInterface $searchCriteriaBuilderFactory
    ): self {
        if ($this->hasSearchCriteriaBuilderFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;

        return $this;
    }

    protected function getSearchCriteriaBuilderFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaBuilderFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory;
    }

    protected function hasSearchCriteriaBuilderFactory(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory);
    }

    protected function unsetSearchCriteriaBuilderFactory(): self
    {
        if (!$this->hasSearchCriteriaBuilderFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory);

        return $this;
    }
}
