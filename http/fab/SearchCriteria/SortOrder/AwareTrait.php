<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder;

    public function setSearchCriteriaSortOrder(SortOrderInterface $searchCriteriaSortOrder): self
    {
        if ($this->hasSearchCriteriaSortOrder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder = $searchCriteriaSortOrder;

        return $this;
    }

    protected function getSearchCriteriaSortOrder(): SortOrderInterface
    {
        if (!$this->hasSearchCriteriaSortOrder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder;
    }

    protected function hasSearchCriteriaSortOrder(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder);
    }

    protected function unsetSearchCriteriaSortOrder(): self
    {
        if (!$this->hasSearchCriteriaSortOrder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder);

        return $this;
    }
}
