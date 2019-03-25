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
    use Doctrine\DBAL\Connection\Decorator\Repository\AwareTrait;

    protected $queryBuilder;

    /**
     * @var array
     */
    private $parameterPlaceholders;

    public function addFilter(FilterInterface $filter): SearchCriteria\VisitorInterface
    {
        $field = $filter->getField();
        switch ($filter->getCondition()) {
            case 'in':
                $where = $this->getQueryBuilder()->expr()->in(
                    $field,
                    $this->getParameterPlaceholders($filter)
                );
                break;
            case 'nin':
                $where = $this->getQueryBuilder()->expr()->notIn(
                    $field,
                    $this->getParameterPlaceholders($filter)
                );
                break;
            case 'eq':
                $where = $this->getQueryBuilder()->expr()->eq(
                    $field,
                    $this->getParameterPlaceholders($filter)[0]
                );
                break;
            case 'neq':
                $where = $this->getQueryBuilder()->expr()->neq(
                    $field,
                    $this->getParameterPlaceholders($filter)[0]
                );
                break;
            case 'lt':
                $where = $this->getQueryBuilder()->expr()->lt(
                    $field,
                    $this->getParameterPlaceholders($filter)[0]
                );
                break;
            case 'lte':
                $where = $this->getQueryBuilder()->expr()->lte(
                    $field,
                    $this->getParameterPlaceholders($filter)[0]
                );
                break;
            case 'gt':
                $where = $this->getQueryBuilder()->expr()->gt(
                    $field,
                    $this->getParameterPlaceholders($filter)[0]
                );
                break;
            case 'gte':
                $where = $this->getQueryBuilder()->expr()->gte(
                    $field,
                    $this->getParameterPlaceholders($filter)[0]
                );
                break;
            case 'like':
                $where = $this->getQueryBuilder()->expr()->like(
                    $field,
                    $this->getParameterPlaceholders($filter)[0]
                );
                break;
            case 'nlike':
                $where = $this->getQueryBuilder()->expr()->notLike(
                    $field,
                    $this->getParameterPlaceholders($filter)[0]
                );
                break;
            case 'is_null':
                $where = $this->getQueryBuilder()->expr()->isNull($field);
                break;
            case 'is_not_null':
                $where = $this->getQueryBuilder()->expr()->isNotNull($field);
                break;
            case 'st_contains':
                $where = sprintf(
                    "ST_Contains(%s, st_geomfromtext(%s))",
                    $field,
                    $this->getParameterPlaceholders($filter)[0]
                );
                break;
            case 'st_dwithin':
                $where = sprintf(
                    'ST_DWithin(%s, %s, %s)',
                    $field,
                    $this->getParameterPlaceholders($filter)['center'],
                    $this->getParameterPlaceholders($filter)['radius']
                );
                break;
            case 'st_within':
                $where = sprintf(
                    "ST_Within(%s, st_buffer(st_geomfromtext(%s), %s))",
                    $field,
                    $this->getParameterPlaceholders($filter)['center'],
                    $this->getParameterPlaceholders($filter)['radius']
                );
                break;
            case 'contains':
                $where = sprintf(
                    "%s @> ARRAY[%s]",
                    $field,
                    implode(',', $this->getParameterPlaceholders($filter))
                );
                break;
            case 'jsonb_key_exist':
                $where = sprintf(
                    "jsonb_exists(%s,%s)",
                    $field,
                    $this->getParameterPlaceholders($filter)[0]
                );
                break;
            case 'overlaps':
                $where = sprintf(
                    "%s && ARRAY[%s]",
                    $field,
                    implode(',', $this->getParameterPlaceholders($filter))
                );
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

    public function getParameterPlaceholders(FilterInterface $filter): array
    {
        if (null === $this->parameterPlaceholders) {
            $parameterPlaceholders = [];
            foreach ($filter->getValues() as $key => $value) {
                $parameterPlaceholders[$key] = $this->getQueryBuilder()->createNamedParameter($value);
            }

            $this->parameterPlaceholders = $parameterPlaceholders;
        }

        return $this->parameterPlaceholders;
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
