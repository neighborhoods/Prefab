<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Filter\Map;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Filter\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap;

    public function setSearchCriteriaFilterMap(MapInterface $searchCriteriaFilterMap): self
    {
        if ($this->hasSearchCriteriaFilterMap()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap = $searchCriteriaFilterMap;

        return $this;
    }

    protected function getSearchCriteriaFilterMap(): MapInterface
    {
        if (!$this->hasSearchCriteriaFilterMap()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap;
    }

    protected function hasSearchCriteriaFilterMap(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap);
    }

    protected function unsetSearchCriteriaFilterMap(): self
    {
        if (!$this->hasSearchCriteriaFilterMap()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMap);

        return $this;
    }
}
