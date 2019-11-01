<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Visitor\Factory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Visitor\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory;

    public function setSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory(
        FactoryInterface $searchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory
    ): self {
        if ($this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory = $searchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory;

        return $this;
    }

    protected function getSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory(): FactoryInterface
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory;
    }

    protected function hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory);
    }

    protected function unsetSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory(): self
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitorFactory);

        return $this;
    }
}
