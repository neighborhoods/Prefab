<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap;

    public function setSearchCriteriaSortOrderMap(MapInterface $searchCriteriaSortOrderMap): self
    {
        if ($this->hasSearchCriteriaSortOrderMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap = $searchCriteriaSortOrderMap;

        return $this;
    }

    protected function getSearchCriteriaSortOrderMap(): MapInterface
    {
        if (!$this->hasSearchCriteriaSortOrderMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap;
    }

    protected function hasSearchCriteriaSortOrderMap(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap);
    }

    protected function unsetSearchCriteriaSortOrderMap(): self
    {
        if (!$this->hasSearchCriteriaSortOrderMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap);

        return $this;
    }
}
