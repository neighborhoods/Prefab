<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Filter;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\FilterInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilter;

    public function setSearchCriteriaFilter(FilterInterface $searchCriteriaFilter): self
    {
        if ($this->hasSearchCriteriaFilter()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilter is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilter = $searchCriteriaFilter;

        return $this;
    }

    protected function getSearchCriteriaFilter(): FilterInterface
    {
        if (!$this->hasSearchCriteriaFilter()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilter is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilter;
    }

    protected function hasSearchCriteriaFilter(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilter);
    }

    protected function unsetSearchCriteriaFilter(): self
    {
        if (!$this->hasSearchCriteriaFilter()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilter is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilter);

        return $this;
    }
}
