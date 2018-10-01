<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\ServerRequest\Builder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\ServerRequest\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder;

    public function setSearchCriteriaServerRequestBuilder(BuilderInterface $searchCriteriaServerRequestBuilder): self
    {
        if ($this->hasSearchCriteriaServerRequestBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder = $searchCriteriaServerRequestBuilder;

        return $this;
    }

    protected function getSearchCriteriaServerRequestBuilder(): BuilderInterface
    {
        if (!$this->hasSearchCriteriaServerRequestBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder;
    }

    protected function hasSearchCriteriaServerRequestBuilder(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder);
    }

    protected function unsetSearchCriteriaServerRequestBuilder(): self
    {
        if (!$this->hasSearchCriteriaServerRequestBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductSearchCriteriaServerRequestBuilder);

        return $this;
    }
}
