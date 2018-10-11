<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory;

    public function setSearchCriteriaSortOrderFactory(FactoryInterface $searchCriteriaSortOrderFactory): self
    {
        if ($this->hasSearchCriteriaSortOrderFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory = $searchCriteriaSortOrderFactory;

        return $this;
    }

    protected function getSearchCriteriaSortOrderFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaSortOrderFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory;
    }

    protected function hasSearchCriteriaSortOrderFactory(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory);
    }

    protected function unsetSearchCriteriaSortOrderFactory(): self
    {
        if (!$this->hasSearchCriteriaSortOrderFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderFactory);

        return $this;
    }
}
