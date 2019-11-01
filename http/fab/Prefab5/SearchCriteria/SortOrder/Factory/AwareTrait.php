<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\SortOrder\Factory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\SortOrder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory;

    public function setSearchCriteriaSortOrderFactory(FactoryInterface $searchCriteriaSortOrderFactory): self
    {
        if ($this->hasSearchCriteriaSortOrderFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory = $searchCriteriaSortOrderFactory;

        return $this;
    }

    protected function getSearchCriteriaSortOrderFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaSortOrderFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory;
    }

    protected function hasSearchCriteriaSortOrderFactory(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory);
    }

    protected function unsetSearchCriteriaSortOrderFactory(): self
    {
        if (!$this->hasSearchCriteriaSortOrderFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory);

        return $this;
    }
}
