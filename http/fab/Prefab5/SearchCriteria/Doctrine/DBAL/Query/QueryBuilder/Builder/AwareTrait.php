<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder;

    public function setSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder(
        BuilderInterface $searchCriteriaDoctrineDBALQueryQueryBuilderBuilder
    ): self {
        if ($this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder = $searchCriteriaDoctrineDBALQueryQueryBuilderBuilder;

        return $this;
    }

    protected function getSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder(): BuilderInterface
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder;
    }

    protected function hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder);
    }

    protected function unsetSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder(): self
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilder);

        return $this;
    }
}
