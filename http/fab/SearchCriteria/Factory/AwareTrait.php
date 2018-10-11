<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFactory;

    public function setSearchCriteriaFactory(FactoryInterface $searchCriteriaFactory): self
    {
        if ($this->hasSearchCriteriaFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFactory = $searchCriteriaFactory;

        return $this;
    }

    protected function getSearchCriteriaFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFactory;
    }

    protected function hasSearchCriteriaFactory(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFactory);
    }

    protected function unsetSearchCriteriaFactory(): self
    {
        if (!$this->hasSearchCriteriaFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFactory);

        return $this;
    }
}
