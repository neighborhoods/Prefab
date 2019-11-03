<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Builder\Factory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory;

    public function setSearchCriteriaBuilderFactory(
        FactoryInterface $searchCriteriaBuilderFactory
    ): self {
        if ($this->hasSearchCriteriaBuilderFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;

        return $this;
    }

    protected function getSearchCriteriaBuilderFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaBuilderFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory;
    }

    protected function hasSearchCriteriaBuilderFactory(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory);
    }

    protected function unsetSearchCriteriaBuilderFactory(): self
    {
        if (!$this->hasSearchCriteriaBuilderFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaBuilderFactory);

        return $this;
    }
}
