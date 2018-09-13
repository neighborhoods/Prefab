<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Repository;


use Neighborhoods\PROJECTNAMEPLACEHOLDER\DAONAMEPLACEHOLDER;
use Neighborhoods\PROJECTNAMEPLACEHOLDER\Doctrine;
use Neighborhoods\PROJECTNAMEPLACEHOLDER\SearchCriteria;
use Neighborhoods\PROJECTNAMEPLACEHOLDER\SearchCriteriaInterface;

class Template // implements RepositoryInterface
{
//    use Doctrine\DBAL\Connection\Decorator\Repository\AwareTrait;
//    use SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder\Factory\AwareTrait;
//    use DAONAMEPLACEHOLDER\Builder\Factory\AwareTrait;

    public function createBuilder() : BuilderInterface
    {
        return $this->getDAOVARNAMEPLACEHOLDERBuilderFactory()->create();
    }

    public function get(SearchCriteriaInterface $searchCriteria) : NAMESPACEPLACEHOLDER\MapInterface
    {
        $queryBuilderBuilder = $this->getSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()->create();
        $queryBuilderBuilder->setSearchCriteria($searchCriteria);
        $queryBuilder = $queryBuilderBuilder->build();
        $queryBuilder->from(DAONAMEPLACEHOLDERInterface::TABLE_NAME)->select('*');
        $records = $queryBuilder->execute()->fetchAll();

        return $this->createBuilder()->setRecords($records)->build();
    }

    public function save(MapInterface $map) : NAMESPACEPLACEHOLDER\RepositoryInterface
    {
        // Use Doctrine Connection Decorator Repository to save your DAO to storage.

        return $this;
    }
}
