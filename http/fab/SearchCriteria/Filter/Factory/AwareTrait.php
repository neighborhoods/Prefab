<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Filter\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Filter\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory;

    public function setSearchCriteriaFilterFactory(FactoryInterface $searchCriteriaFilterFactory): self
    {
        if ($this->hasSearchCriteriaFilterFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory = $searchCriteriaFilterFactory;

        return $this;
    }

    protected function getSearchCriteriaFilterFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaFilterFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory;
    }

    protected function hasSearchCriteriaFilterFactory(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory);
    }

    protected function unsetSearchCriteriaFilterFactory(): self
    {
        if (!$this->hasSearchCriteriaFilterFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterFactory);

        return $this;
    }
}
