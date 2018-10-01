<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Filter\Map\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Filter\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory;

    public function setSearchCriteriaFilterMapFactory(FactoryInterface $searchCriteriaFilterMapFactory): self
    {
        if ($this->hasSearchCriteriaFilterMapFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory = $searchCriteriaFilterMapFactory;

        return $this;
    }

    protected function getSearchCriteriaFilterMapFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaFilterMapFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory;
    }

    protected function hasSearchCriteriaFilterMapFactory(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory);
    }

    protected function unsetSearchCriteriaFilterMapFactory(): self
    {
        if (!$this->hasSearchCriteriaFilterMapFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaFilterMapFactory);

        return $this;
    }
}
