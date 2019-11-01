<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\ServerRequest\Builder\Factory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\ServerRequest\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory;

    public function setSearchCriteriaServerRequestBuilderFactory(
        FactoryInterface $searchCriteriaServerRequestBuilderFactory
    ): self {
        if ($this->hasSearchCriteriaServerRequestBuilderFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory = $searchCriteriaServerRequestBuilderFactory;

        return $this;
    }

    protected function getSearchCriteriaServerRequestBuilderFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaServerRequestBuilderFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory;
    }

    protected function hasSearchCriteriaServerRequestBuilderFactory(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory);
    }

    protected function unsetSearchCriteriaServerRequestBuilderFactory(): self
    {
        if (!$this->hasSearchCriteriaServerRequestBuilderFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory);

        return $this;
    }
}
