<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\ServerRequest\Builder\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\ServerRequest\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory;

    public function setSearchCriteriaServerRequestBuilderFactory(
        FactoryInterface $searchCriteriaServerRequestBuilderFactory
    ): self {
        if ($this->hasSearchCriteriaServerRequestBuilderFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory = $searchCriteriaServerRequestBuilderFactory;

        return $this;
    }

    protected function getSearchCriteriaServerRequestBuilderFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaServerRequestBuilderFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory;
    }

    protected function hasSearchCriteriaServerRequestBuilderFactory(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory);
    }

    protected function unsetSearchCriteriaServerRequestBuilderFactory(): self
    {
        if (!$this->hasSearchCriteriaServerRequestBuilderFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilderFactory);

        return $this;
    }
}
