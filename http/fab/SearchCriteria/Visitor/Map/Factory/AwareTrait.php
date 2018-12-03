<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Visitor\Map\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Visitor\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory;

    public function setSearchCriteriaVisitorMapFactory(FactoryInterface $searchCriteriaVisitorMapFactory) : self
    {
        if ($this->hasSearchCriteriaVisitorMapFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory = $searchCriteriaVisitorMapFactory;

        return $this;
    }

    protected function getSearchCriteriaVisitorMapFactory() : FactoryInterface
    {
        if (!$this->hasSearchCriteriaVisitorMapFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory;
    }

    protected function hasSearchCriteriaVisitorMapFactory() : bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory);
    }

    protected function unsetSearchCriteriaVisitorMapFactory() : self
    {
        if (!$this->hasSearchCriteriaVisitorMapFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaVisitorMapFactory);

        return $this;
    }
}
