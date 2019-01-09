<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder;

use Doctrine\DBAL\Query\QueryBuilder;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\FilterInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\SortOrderInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\DecoratorInterface;

class Visitor implements VisitorInterface
{
    protected $queryBuilder;
    use Doctrine\DBAL\Connection\Decorator\Repository\AwareTrait;

    public function addFilter(FilterInterface $filter): SearchCriteria\VisitorInterface
    {
        $parameterPlaceholders = [];
        foreach ($filter->getValues() as $key => $value) {
            $parameterPlaceholders[$key] = $this->getQueryBuilder()->createNamedParameter($value);
        }
        $field = $filter->getField();
        switch ($filter->getCondition()) {
            case 'in':
                $where = $this->getQueryBuilder()->expr()->in($field, $parameterPlaceholders);
                break;
            case 'nin':
                $where = $this->getQueryBuilder()->expr()->notIn($field, $parameterPlaceholders);
                break;
            case 'eq':
                $where = $this->getQueryBuilder()->expr()->eq($field, $parameterPlaceholders[0]);
                break;
            case 'neq':
                $where = $this->getQueryBuilder()->expr()->neq($field, $parameterPlaceholders[0]);
                break;
            case 'lt':
                $where = $this->getQueryBuilder()->expr()->lt($field, $parameterPlaceholders[0]);
                break;
            case 'lte':
                $where = $this->getQueryBuilder()->expr()->lte($field, $parameterPlaceholders[0]);
                break;
            case 'gt':
                $where = $this->getQueryBuilder()->expr()->gt($field, $parameterPlaceholders[0]);
                break;
            case 'gte':
                $where = $this->getQueryBuilder()->expr()->gte($field, $parameterPlaceholders[0]);
                break;
            case 'like':
                $where = $this->getQueryBuilder()->expr()->like($field, $parameterPlaceholders[0]);
                break;
            case 'nlike':
                $where = $this->getQueryBuilder()->expr()->notLike($field, $parameterPlaceholders[0]);
                break;
            case 'st_contains':
                $where = sprintf("ST_Contains(%s, st_geomfromtext(%s))", $field, $parameterPlaceholders[0]);
                break;
            case 'st_dwithin':
                $where = sprintf('ST_DWithin(%s, %s, %s)', $field, $parameterPlaceholders['center'], $parameterPlaceholders['radius']);
                break;
            case 'st_within':
                $where = sprintf("ST_Within(%s, st_buffer(st_geomfromtext(%s), %s))", $field, $parameterPlaceholders['center'], $parameterPlaceholders['radius']);
                break;
            case 'contains':
                $where = sprintf("%s @> ARRAY[%s]", $field,  implode(',',$parameterPlaceholders));
                break;
            case 'jsonb_key_exist':
                $where = sprintf("jsonb_exists(%s,%s)", $field,  $parameterPlaceholders[0]);
                break;
            case 'overlaps':
                $where = sprintf("%s && ARRAY[%s]", $field, implode(',', $parameterPlaceholders));
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
