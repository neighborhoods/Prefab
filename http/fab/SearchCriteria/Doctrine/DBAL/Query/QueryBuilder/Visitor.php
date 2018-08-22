<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder;

use Doctrine\DBAL\Query\QueryBuilder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\FilterInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrderInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Doctrine;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Doctrine\DBAL\Connection\DecoratorInterface;

class Visitor implements VisitorInterface
{
    protected $queryBuilder;
    use Doctrine\DBAL\Connection\Decorator\Repository\AwareTrait;

    public function addFilter(FilterInterface $filter): SearchCriteria\VisitorInterface
    {
        $values = [];
        foreach ($filter->getValues() as $value) {
            $values[] = $this->getQueryBuilder()->createNamedParameter($value);
        }
        $field = $filter->getField();
        switch ($filter->getCondition()) {
            case 'in':
                $where = $this->getQueryBuilder()->expr()->in($field, $values);
                break;
            case 'nin':
                $where = $this->getQueryBuilder()->expr()->notIn($field, $values);
                break;
            case 'eq':
                $where = $this->getQueryBuilder()->expr()->eq($field, $values[0]);
                break;
            case 'neq':
                $where = $this->getQueryBuilder()->expr()->neq($field, $values[0]);
                break;
            case 'lt':
                $where = $this->getQueryBuilder()->expr()->lt($field, $values[0]);
                break;
            case 'lte':
                $where = $this->getQueryBuilder()->expr()->lte($field, $values[0]);
                break;
            case 'gt':
                $where = $this->getQueryBuilder()->expr()->gt($field, $values[0]);
                break;
            case 'gte':
                $where = $this->getQueryBuilder()->expr()->gte($field, $values[0]);
                break;
            case 'like':
                $where = $this->getQueryBuilder()->expr()->like($field, $values[0]);
                break;
            case 'nlike':
                $where = $this->getQueryBuilder()->expr()->notLike($field, $values[0]);
                break;
            case 'st_contains':
                $where = sprintf("ST_Contains('%s', %s)", $values[0], $field);
                break;
            default:
                throw new \LogicException('Unknown filter condition.');
        }
        if ($filter->getGlue() === 'and') {
            $this->getQueryBuilder()->andWhere($where);
        } elseif ($filter->getGlue() === 'or') {
            $this->getQueryBuilder()->orWhere($where);
        }

        return $this;
    }

    public function addSortOrder(SortOrderInterface $sortOrder): SearchCriteria\VisitorInterface
    {
        $this->getQueryBuilder()->addOrderBy($sortOrder->getField(), $sortOrder->getDirection());

        return $this;
    }

    public function setPageSize(int $pageSize): SearchCriteria\VisitorInterface
    {
        $this->getQueryBuilder()->setMaxResults($pageSize);

        return $this;
    }

    public function setCurrentPage(int $currentPage): SearchCriteria\VisitorInterface
    {
        $this->getQueryBuilder()->setFirstResult($this->getQueryBuilder()->getMaxResults() * $currentPage);

        return $this;
    }

    public function getQueryBuilder(): QueryBuilder
    {
        if ($this->queryBuilder === null) {
            $doctrineConnectionDecoratorRepository = $this->getDoctrineDBALConnectionDecoratorRepository();
            $this->queryBuilder = $doctrineConnectionDecoratorRepository->createQueryBuilder(DecoratorInterface::ID_CORE);
        }

        return $this->queryBuilder;
    }
}
