<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Map;

use Neighborhoods\Bradfab\Template\ActorInterface;

use Doctrine\DBAL\Connection;
use Neighborhoods\Bradfab\Template\Actor;
use Neighborhoods\Bradfab\Template\Actor\MapInterface;
/** @neighborhoods-bradfab:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository-ProjectName */
class Repository implements RepositoryInterface
{
    use Actor\Map\Builder\Factory\AwareTrait;
    use Doctrine\DBAL\Connection\Decorator\Repository\AwareTrait;
    use SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder\Factory\AwareTrait;

    protected $connection;

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
