<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Filter\Factory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Filter\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory;

    public function setSearchCriteriaFilterFactory(FactoryInterface $searchCriteriaFilterFactory): self
    {
        if ($this->hasSearchCriteriaFilterFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory = $searchCriteriaFilterFactory;

        return $this;
    }

    protected function getSearchCriteriaFilterFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaFilterFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory;
    }

    protected function hasSearchCriteriaFilterFactory(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory);
    }

    protected function unsetSearchCriteriaFilterFactory(): self
    {
        if (!$this->hasSearchCriteriaFilterFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory);

        return $this;
    }
}
