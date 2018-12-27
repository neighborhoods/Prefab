<?php
declare(strict_types=1);
namespace Neighborhoods\Prefab\Actor\Repository;


use Neighborhoods\PROJECTNAMEPLACEHOLDER\DAONAMEPLACEHOLDER;
use Neighborhoods\PROJECTNAMEPLACEHOLDER\Prefab4\Doctrine;
use Neighborhoods\PROJECTNAMEPLACEHOLDER\Prefab4\SearchCriteria;
use Neighborhoods\PROJECTNAMEPLACEHOLDER\Prefab4\SearchCriteriaInterface;

class Template // implements RepositoryInterface
{
//    use Prefab4\Doctrine\DBAL\Connection\Decorator\Repository\AwareTrait;
//    use Prefab4\SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder\Factory\AwareTrait;
//    use DAONAMEPLACEHOLDER\Map\Builder\Factory\AwareTrait;

    public function createBuilder() : \NAMESPACEPLACEHOLDER\BuilderInterface
    {
        return $this->getDAOVARNAMEPLACEHOLDERBuilderFactory()->create();
    }

    public function get(SearchCriteriaInterface $searchCriteria) : \DAONAMEPLACEHOLDERInterface
    {
        $queryBuilderBuilder = $this->getSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()->create();
        $queryBuilderBuilder->setSearchCriteria($searchCriteria);
        $queryBuilder = $queryBuilderBuilder->build();
        $queryBuilder->from(\PARENTNAMESPACEPLACEHOLDERInterface::TABLE_NAME)->select('*');
        $records = $queryBuilder->execute()->fetchAll();

        return $this->createBuilder()->setRecords($records)->build();
    }

    public function save(\NAMESPACEPLACEHOLDERInterface $map) : \NAMESPACEPLACEHOLDER\RepositoryInterface
    {
        // Use Doctrine Connection Decorator Repository to save your DAO to storage.

        return $this;
    }
}
