<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Visitor\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Visitor\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap;

    public function setSearchCriteriaVisitorMap(MapInterface $searchCriteriaVisitorMap): self
    {
        if ($this->hasSearchCriteriaVisitorMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap = $searchCriteriaVisitorMap;

        return $this;
    }

    protected function getSearchCriteriaVisitorMap(): MapInterface
    {
        if (!$this->hasSearchCriteriaVisitorMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap;
    }

    protected function hasSearchCriteriaVisitorMap(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap);
    }

    protected function unsetSearchCriteriaVisitorMap(): self
    {
        if (!$this->hasSearchCriteriaVisitorMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap);

        return $this;
    }
}
