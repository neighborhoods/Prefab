<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\SortOrder;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\SortOrderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder;

    public function setSearchCriteriaSortOrder(SortOrderInterface $searchCriteriaSortOrder): self
    {
        if ($this->hasSearchCriteriaSortOrder()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder = $searchCriteriaSortOrder;

        return $this;
    }

    protected function getSearchCriteriaSortOrder(): SortOrderInterface
    {
        if (!$this->hasSearchCriteriaSortOrder()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder;
    }

    protected function hasSearchCriteriaSortOrder(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder);
    }

    protected function unsetSearchCriteriaSortOrder(): self
    {
        if (!$this->hasSearchCriteriaSortOrder()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrder);

        return $this;
    }
}
