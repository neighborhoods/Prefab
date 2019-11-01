<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Visitor\Map;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Visitor\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap;

    public function setSearchCriteriaVisitorMap(MapInterface $searchCriteriaVisitorMap): self
    {
        if ($this->hasSearchCriteriaVisitorMap()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap = $searchCriteriaVisitorMap;

        return $this;
    }

    protected function getSearchCriteriaVisitorMap(): MapInterface
    {
        if (!$this->hasSearchCriteriaVisitorMap()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap;
    }

    protected function hasSearchCriteriaVisitorMap(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap);
    }

    protected function unsetSearchCriteriaVisitorMap(): self
    {
        if (!$this->hasSearchCriteriaVisitorMap()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMap);

        return $this;
    }
}
