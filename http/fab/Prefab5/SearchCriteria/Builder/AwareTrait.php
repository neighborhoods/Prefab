<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Builder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilder;

    public function setSearchCriteriaBuilder(BuilderInterface $searchCriteriaBuilder): self
    {
        if ($this->hasSearchCriteriaBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilder is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilder = $searchCriteriaBuilder;

        return $this;
    }

    protected function getSearchCriteriaBuilder(): BuilderInterface
    {
        if (!$this->hasSearchCriteriaBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilder is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilder;
    }

    protected function hasSearchCriteriaBuilder(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilder);
    }

    protected function unsetSearchCriteriaBuilder(): self
    {
        if (!$this->hasSearchCriteriaBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilder is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaBuilder);

        return $this;
    }
}
