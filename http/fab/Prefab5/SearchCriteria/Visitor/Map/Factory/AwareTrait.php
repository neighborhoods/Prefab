<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Visitor\Map\Factory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Visitor\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory;

    public function setSearchCriteriaVisitorMapFactory(FactoryInterface $searchCriteriaVisitorMapFactory) : self
    {
        if ($this->hasSearchCriteriaVisitorMapFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory = $searchCriteriaVisitorMapFactory;

        return $this;
    }

    protected function getSearchCriteriaVisitorMapFactory() : FactoryInterface
    {
        if (!$this->hasSearchCriteriaVisitorMapFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory;
    }

    protected function hasSearchCriteriaVisitorMapFactory() : bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory);
    }

    protected function unsetSearchCriteriaVisitorMapFactory() : self
    {
        if (!$this->hasSearchCriteriaVisitorMapFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory);

        return $this;
    }
}
