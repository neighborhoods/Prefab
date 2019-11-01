<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\SortOrder\Map\Factory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\SortOrder\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory;

    public function setSearchCriteriaSortOrderMapFactory(FactoryInterface $searchCriteriaSortOrderMapFactory): self
    {
        if ($this->hasSearchCriteriaSortOrderMapFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory = $searchCriteriaSortOrderMapFactory;

        return $this;
    }

    protected function getSearchCriteriaSortOrderMapFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaSortOrderMapFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory;
    }

    protected function hasSearchCriteriaSortOrderMapFactory(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory);
    }

    protected function unsetSearchCriteriaSortOrderMapFactory(): self
    {
        if (!$this->hasSearchCriteriaSortOrderMapFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory);

        return $this;
    }
}
