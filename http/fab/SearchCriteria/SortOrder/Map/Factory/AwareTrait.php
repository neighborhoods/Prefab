<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder\Map\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory;

    public function setSearchCriteriaSortOrderMapFactory(FactoryInterface $searchCriteriaSortOrderMapFactory): self
    {
        if ($this->hasSearchCriteriaSortOrderMapFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory = $searchCriteriaSortOrderMapFactory;

        return $this;
    }

    protected function getSearchCriteriaSortOrderMapFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaSortOrderMapFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory;
    }

    protected function hasSearchCriteriaSortOrderMapFactory(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory);
    }

    protected function unsetSearchCriteriaSortOrderMapFactory(): self
    {
        if (!$this->hasSearchCriteriaSortOrderMapFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaSortOrderMapFactory);

        return $this;
    }
}
