<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteriaInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteria;

    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria): self
    {
        if ($this->hasSearchCriteria()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteria is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteria = $searchCriteria;

        return $this;
    }

    protected function getSearchCriteria(): SearchCriteriaInterface
    {
        if (!$this->hasSearchCriteria()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteria is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteria;
    }

    protected function hasSearchCriteria(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteria);
    }

    protected function unsetSearchCriteria(): self
    {
        if (!$this->hasSearchCriteria()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteria is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteria);

        return $this;
    }
}
