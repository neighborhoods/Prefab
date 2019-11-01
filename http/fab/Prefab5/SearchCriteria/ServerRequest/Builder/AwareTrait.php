<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\ServerRequest\Builder;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\ServerRequest\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder;

    public function setSearchCriteriaServerRequestBuilder(BuilderInterface $searchCriteriaServerRequestBuilder): self
    {
        if ($this->hasSearchCriteriaServerRequestBuilder()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder = $searchCriteriaServerRequestBuilder;

        return $this;
    }

    protected function getSearchCriteriaServerRequestBuilder(): BuilderInterface
    {
        if (!$this->hasSearchCriteriaServerRequestBuilder()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder;
    }

    protected function hasSearchCriteriaServerRequestBuilder(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder);
    }

    protected function unsetSearchCriteriaServerRequestBuilder(): self
    {
        if (!$this->hasSearchCriteriaServerRequestBuilder()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder);

        return $this;
    }
}
