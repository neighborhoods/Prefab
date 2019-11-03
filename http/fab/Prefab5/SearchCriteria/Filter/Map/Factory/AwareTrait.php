<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Filter\Map\Factory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Filter\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory;

    public function setSearchCriteriaFilterMapFactory(FactoryInterface $searchCriteriaFilterMapFactory): self
    {
        if ($this->hasSearchCriteriaFilterMapFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory = $searchCriteriaFilterMapFactory;

        return $this;
    }

    protected function getSearchCriteriaFilterMapFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaFilterMapFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory;
    }

    protected function hasSearchCriteriaFilterMapFactory(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory);
    }

    protected function unsetSearchCriteriaFilterMapFactory(): self
    {
        if (!$this->hasSearchCriteriaFilterMapFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory);

        return $this;
    }
}
