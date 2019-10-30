<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Visitor;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\VisitorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor;

    public function setSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor(
        VisitorInterface $searchCriteriaDoctrineDBALQueryQueryBuilderVisitor
    ): self {
        if ($this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor = $searchCriteriaDoctrineDBALQueryQueryBuilderVisitor;

        return $this;
    }

    protected function getSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor(): VisitorInterface
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor;
    }

    protected function hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor);
    }

    protected function unsetSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor(): self
    {
        if (!$this->hasSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductSearchCriteriaDoctrineDBALQueryQueryBuilderVisitor);

        return $this;
    }
}
