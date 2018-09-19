<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Filter\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Filter\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap;

    public function setSearchCriteriaFilterMap(MapInterface $searchCriteriaFilterMap): self
    {
        if ($this->hasSearchCriteriaFilterMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap = $searchCriteriaFilterMap;

        return $this;
    }

    protected function getSearchCriteriaFilterMap(): MapInterface
    {
        if (!$this->hasSearchCriteriaFilterMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap;
    }

    protected function hasSearchCriteriaFilterMap(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap);
    }

    protected function unsetSearchCriteriaFilterMap(): self
    {
        if (!$this->hasSearchCriteriaFilterMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap);

        return $this;
    }
}
