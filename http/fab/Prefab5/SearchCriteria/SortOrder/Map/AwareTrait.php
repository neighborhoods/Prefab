<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\SortOrder\Map;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\SortOrder\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap;

    public function setSearchCriteriaSortOrderMap(MapInterface $searchCriteriaSortOrderMap): self
    {
        if ($this->hasSearchCriteriaSortOrderMap()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap = $searchCriteriaSortOrderMap;

        return $this;
    }

    protected function getSearchCriteriaSortOrderMap(): MapInterface
    {
        if (!$this->hasSearchCriteriaSortOrderMap()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap;
    }

    protected function hasSearchCriteriaSortOrderMap(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap);
    }

    protected function unsetSearchCriteriaSortOrderMap(): self
    {
        if (!$this->hasSearchCriteriaSortOrderMap()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMap);

        return $this;
    }
}
