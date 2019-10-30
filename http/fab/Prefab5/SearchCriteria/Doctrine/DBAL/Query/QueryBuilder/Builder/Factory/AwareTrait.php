<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder\Factory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory;

    public function setSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory(
        FactoryInterface $searchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory
    ): self {
        if ($this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory = $searchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory;

        return $this;
    }

    protected function getSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory;
    }

    protected function hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory);
    }

    protected function unsetSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory(): self
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory);

        return $this;
    }
}
