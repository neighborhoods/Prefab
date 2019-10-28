<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\Actor\Map;

use Neighborhoods\BuphaloTemplateTree\ActorInterface;

use Doctrine\DBAL\Connection;
use Neighborhoods\BuphaloTemplateTree\Actor;
use Neighborhoods\BuphaloTemplateTree\Actor\Map;
use Neighborhoods\BuphaloTemplateTree\Actor\MapInterface;
/** @neighborhoods-buphalo:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-ProjectName
 */
class Repository implements RepositoryInterface
{
    use Actor\Map\Builder\Factory\AwareTrait;
    use Doctrine\DBAL\Connection\Decorator\Repository\AwareTrait;
    use SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder\Factory\AwareTrait;

    protected $connection;

    protected const JSON_COLUMNS = [
/** @neighborhoods-buphalo:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-JsonColumns
 */
    ];

    public function createBuilder() : Map\BuilderInterface
    {
        return $this->getActorMapBuilderFactory()->create();
    }

    public function get(SearchCriteriaInterface $searchCriteria) : MapInterface
    {
        $queryBuilderBuilder = $this->getSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()->create();
        $queryBuilderBuilder->setSearchCriteria($searchCriteria);
        $queryBuilder = $queryBuilderBuilder->build();
        $queryBuilder->from(ActorInterface::TABLE_NAME)->select('*');
        $records = $queryBuilder->execute()->fetchAll();

        foreach ($records as $key => $record) {
            foreach (self::JSON_COLUMNS as $jsonColumn) {
                $records[$key][$jsonColumn] = json_decode($records[$key][$jsonColumn], true);
            }
        }

        return $this->createBuilder()->setRecords($records)->build();
    }

    public function save(MapInterface $property) : RepositoryInterface
    {
        // TODO: Implement Save Method
        return $this;
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
