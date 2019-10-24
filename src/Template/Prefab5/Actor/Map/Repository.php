<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Map;

use Neighborhoods\Bradfab\Template\ActorInterface;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Query\QueryBuilder;
use Neighborhoods\Bradfab\Template\Actor;
use Neighborhoods\Bradfab\Template\Actor\MapInterface;
/** @neighborhoods-bradfab:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-ProjectName 
 */
class Repository implements RepositoryInterface
{
    use Actor\Map\Builder\Factory\AwareTrait;
    use Doctrine\DBAL\Connection\Decorator\Repository\AwareTrait;
    use SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder\Factory\AwareTrait;

    protected $connection;

    protected const JSON_COLUMNS = [
/** @neighborhoods-bradfab:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-JsonColumns
 */
    ];

    public function createBuilder() : \Neighborhoods\Bradfab\Template\Actor\Map\BuilderInterface
    {
        return $this->getActorMapBuilderFactory()->create();
    }

    public function get(SearchCriteriaInterface $searchCriteria) : \Neighborhoods\Bradfab\Template\Actor\MapInterface
    {
        $queryBuilderBuilder = $this->getSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()->create();
        $queryBuilderBuilder->setSearchCriteria($searchCriteria);
        $queryBuilder = $queryBuilderBuilder->build();
        $queryBuilder->from(\Neighborhoods\Bradfab\Template\ActorInterface::TABLE_NAME)->select('*');
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
                                     ActorInterface $Actor) : ActorInterface
    {
        $values = [];

/** @neighborhoods-bradfab:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-insertElement
 */

        $queryBuilder
            ->insert(ActorInterface::TABLE_NAME)
            ->values($values);
        $queryBuilder->execute();
        $lastInsertId = $queryBuilder->getConnection()->lastInsertId();
        if (!is_numeric($lastInsertId)) {
            throw new \LogicException('Actor inserted with non-numeric ID: ' . $lastInsertId);
        }

        return $Actor;
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
                                     ActorInterface $Actor) : ActorInterface
    {
        $values = [];

/** @neighborhoods-bradfab:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-updateElement
 */

        $queryBuilder
            ->insert(ActorInterface::TABLE_NAME)
            ->values($values);
        $queryBuilder->execute();

        return $Actor;
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
