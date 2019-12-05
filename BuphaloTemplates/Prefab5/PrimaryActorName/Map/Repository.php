<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorNameInterface;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Query\QueryBuilder;
use Neighborhoods\BuphaloTemplateTree\PrimaryActorName;
use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map;
use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\MapInterface;
use PREFAB_PLACEHOLDER_VENDOR\PREFAB_PLACEHOLDER_PRODUCT\Prefab5;

class Repository implements RepositoryInterface
{
    use PrimaryActorName\Map\Builder\Factory\AwareTrait;
    use Prefab5\Doctrine\DBAL\Connection\Decorator\Repository\AwareTrait;
    use Prefab5\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder\Factory\AwareTrait;

    protected $connection;

    protected const JSON_COLUMNS = [
/** @neighborhoods-buphalo:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-JsonColumns
 */
    ];

    public function createBuilder() : Map\BuilderInterface
    {
        return $this->getPrimaryActorNameMapBuilderFactory()->create();
    }

    public function get(Prefab5\SearchCriteriaInterface $searchCriteria) : MapInterface
    {
        $queryBuilderBuilder = $this->getSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()->create();
        $queryBuilderBuilder->setSearchCriteria($searchCriteria);
        $queryBuilder = $queryBuilderBuilder->build();
        $queryBuilder->from(PrimaryActorNameInterface::TABLE_NAME)->select('*');
        $records = $queryBuilder->execute()->fetchAll();

        foreach ($records as $key => $record) {
            foreach (self::JSON_COLUMNS as $jsonColumn) {
                $records[$key][$jsonColumn] = json_decode($records[$key][$jsonColumn], true);
            }
        }

        return $this->createBuilder()->setRecords($records)->build();
    }

    /** @deprecated - use insert() */
    public function save(MapInterface $map) : RepositoryInterface
    {
        return $this->insert($map);
    }

    public function insert(MapInterface $map) : RepositoryInterface
    {
        $connection = $this->getConnection();
        try {
            $connection->beginTransaction();
            foreach ($map as $record) {
                $this->insertElement($connection->createQueryBuilder(), $record);
            }
            $connection->commit();
        } catch (\Throwable $e) {
            $connection->rollBack();
            throw $e;
        }

        return $this;
    }

    protected function insertElement(QueryBuilder $queryBuilder,
                                     PrimaryActorNameInterface $PrimaryActorName) : PrimaryActorNameInterface
    {
        $values = [];

/** @neighborhoods-buphalo:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-insertElement
 */

        $queryBuilder
            ->insert(PrimaryActorNameInterface::TABLE_NAME)
            ->values($values);
        $queryBuilder->execute();
        $lastInsertId = $queryBuilder->getConnection()->lastInsertId();
        if (!is_numeric($lastInsertId)) {
            throw new \LogicException('PrimaryActorName inserted with non-numeric ID: ' . $lastInsertId);
        }

        return $PrimaryActorName;
    }

    public function update(MapInterface $map) : RepositoryInterface
    {
        $connection = $this->getConnection();
        try {
            $connection->beginTransaction();
            foreach ($map as $record) {
                $this->updateElement($connection->createQueryBuilder(), $record);
            }
            $connection->commit();
        } catch (\Throwable $e) {
            $connection->rollBack();
            throw $e;
        }

        return $this;
    }

    protected function updateElement(QueryBuilder $queryBuilder,
                                     PrimaryActorNameInterface $PrimaryActorName) : PrimaryActorNameInterface
    {
/** @neighborhoods-buphalo:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-updateElement
 */
        $queryBuilder
            ->update(PrimaryActorNameInterface::TABLE_NAME)
            ->where($queryBuilder->expr()->eq(
        /** @neighborhoods-buphalo:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-updateElementIdentityField
          // TODO: Add identity field for where clause
         */
            ));
        $queryBuilder->execute();

        return $PrimaryActorName;
    }

    protected function getConnection() : Connection
    {
        if ($this->connection === null) {
            $this->connection = $this->getDoctrineDBALConnectionDecoratorRepository()->get(Doctrine\DBAL\Connection\DecoratorInterface::ID_CORE)
                ->getDoctrineConnection();
        }

        return $this->connection;
    }
}
