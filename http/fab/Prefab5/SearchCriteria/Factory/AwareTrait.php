<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Factory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFactory;

    public function setSearchCriteriaFactory(FactoryInterface $searchCriteriaFactory): self
    {
        if ($this->hasSearchCriteriaFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFactory is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFactory = $searchCriteriaFactory;

        return $this;
    }

    protected function getSearchCriteriaFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFactory is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFactory;
    }

    protected function hasSearchCriteriaFactory(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFactory);
    }

    protected function unsetSearchCriteriaFactory(): self
    {
        if (!$this->hasSearchCriteriaFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFactory is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFactory);

        return $this;
    }
}
