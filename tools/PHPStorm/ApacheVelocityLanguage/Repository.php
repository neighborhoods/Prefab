#set($namespacePrefix = "")
#set($truncatedClassPath = "")
#set($lastPartOfNamespace = "")
#set($daoUpper = "")
#set($daoLower = "")
#parse("truncated classpath")
<?php
declare(strict_types=1);

namespace ${NAMESPACE};

use ${namespacePrefix}Doctrine;
use ${NAMESPACE};
use ${NAMESPACE}Interface;
use ${namespacePrefix}SearchCriteria;
use ${namespacePrefix}SearchCriteriaInterface;

class Repository implements RepositoryInterface
{
    use Doctrine\DBAL\Connection\Decorator\Repository\AwareTrait;
    use ${daoUpper}\Builder\Factory\AwareTrait;
    use SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder\Factory\AwareTrait;
        
    public function createBuilder(): BuilderInterface
    {
        return ${DS}this->get${truncatedClassPath}BuilderFactory()->create();
    }

    public function get(SearchCriteriaInterface ${DS}searchCriteria): MapInterface
    {
        ${DS}queryBuilderBuilder = ${DS}this->getSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()->create();
        ${DS}queryBuilderBuilder->setSearchCriteria(${DS}searchCriteria);
        ${DS}queryBuilder = ${DS}queryBuilderBuilder->build();
        ${DS}queryBuilder->from(${daoUpper}Interface::TABLE_NAME)->select('*');
        ${DS}records = ${DS}queryBuilder->execute()->fetchAll();

        return ${DS}${daoLower} = ${DS}this->createBuilder()->setRecords(${DS}records)->build();
    }

    public function save(MapInterface ${DS}map): RepositoryInterface
    {
        // Use Doctrine Connection Decorator Repository to save your DAO to storage.

        return ${DS}this;
    }
}