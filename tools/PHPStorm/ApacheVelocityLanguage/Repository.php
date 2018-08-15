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
    use ${daoUpper}\Map\Factory\AwareTrait;
    use ${daoUpper}\Map\AwareTrait;
    use SearchCriteria\Doctrine\DBAL\Query\QueryBuilder\Builder\Factory\AwareTrait;

    public function createBuilder(): BuilderInterface
    {
        return ${DS}this->get${truncatedClassPath}BuilderFactory()->create();
    }

    public function getMap(SearchCriteriaInterface ${DS}searchCriteria): MapInterface
    {
        ${DS}queryBuilderBuilder = ${DS}this->getSearchCriteriaDoctrineDBALQueryQueryBuilderBuilderFactory()->create();
        ${DS}queryBuilderBuilder->setSearchCriteria(${DS}searchCriteria);
        ${DS}queryBuilder = ${DS}queryBuilderBuilder->build();
        ${DS}queryBuilder->from(${daoUpper}Interface::TABLE_NAME)->select('*');
        ${DS}records = ${DS}queryBuilder->execute()->fetchAll();
        ${DS}${daoLower}s = [];
        foreach (${DS}records as ${DS}record) {
            ${DS}${daoLower} = ${DS}this->createBuilder()->setRecord(${DS}record)->build();
            ${DS}${daoLower}s[${DS}${daoLower}->getId()] = ${DS}${daoLower};
        }

        return ${DS}this->get${truncatedClassPath}MapFactory()->create()->hydrate(${DS}${daoLower}s);
    }

    public function save(${daoUpper}Interface ${DS}${daoLower}): RepositoryInterface
    {
        // Use Doctrine Connection Decorator Repository to save your DAO to storage.

        return ${DS}this;
    }

    public function attach(${daoUpper}Interface ${DS}${daoLower}): RepositoryInterface
    {
        ${DS}id = ${DS}${daoLower}->getId();
        if (isset(${DS}this->get${truncatedClassPath}Map()[${DS}id])) {
            throw new \LogicException("${daoUpper} with ID[${DS}id] is already attached.");
        } else {
            ${DS}this->get${truncatedClassPath}Map()[${DS}id] = ${DS}${daoLower};
        }

        return ${DS}this;
    }

    public function detach(${daoUpper}Interface ${DS}${daoLower}): RepositoryInterface
    {
        ${DS}id = ${DS}${daoLower}->getId();
        if (isset(${DS}this->get${truncatedClassPath}Map()[${DS}id])) {
            if (${DS}${daoLower} === ${DS}this->get${truncatedClassPath}Map()[${DS}id]) {
                unset(${DS}this->get${truncatedClassPath}Map()[${DS}id]);
            } else {
                throw new \LogicException('The same ${daoLower} instance is not attached.');
            }
        } else {
            throw new \LogicException("${daoUpper} with ID[${DS}id] is not attached.");
        }

        return ${DS}this;
    }
}
