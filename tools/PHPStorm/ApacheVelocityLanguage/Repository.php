#set($namespacePrefix = "")
#set($truncatedClassPath = "")
#set($lastPartOfNamespace = "")
#set($daoUpper = "")
#set($daoLower = "")
#parse("truncated classpath")
<?php
declare(strict_types=1);

namespace ${NAMESPACE};

use Doctrine\DBAL\Query\QueryBuilder;
use ${namespacePrefix}Doctrine;
use ${namespacePrefix}Doctrine\DBAL\Connection\DecoratorInterface;
use ${NAMESPACE};
use ${namespacePrefix}Repository\Exception;
use ${NAMESPACE}Interface;

class Repository implements RepositoryInterface
{
    use Doctrine\DBAL\Connection\Decorator\Repository\AwareTrait;
    use ${daoUpper}\Factory\AwareTrait;
    use ${daoUpper}\Builder\Factory\AwareTrait;
    use ${daoUpper}\Map\Factory\AwareTrait;
    use ${daoUpper}\Map\AwareTrait;
    
    public function createBuilder(): BuilderInterface
    {
        return ${DS}this->get${truncatedClassPath}BuilderFactory()->create();
    }

    public function get(int ${DS}id): ${daoUpper}Interface
    {
        // Use Doctrine Connection Decorator Repository to retrieve your DAO from storage.
        // DO NOT MEMO-IZE.
        ${DS}queryBuilder = ${DS}this->getNewQueryBuilder();
        ${DS}queryBuilder->where(${DS}queryBuilder->expr()->eq(
            ${daoUpper}Interface::FIELD_ID,
            ${DS}queryBuilder->createNamedParameter(${DS}id))
        );
        ${DS}record = ${DS}queryBuilder->execute()->fetchAll();
        if (isset(${DS}record[0])) {
            if (!isset(${DS}record[1])) {
                ${DS}${daoLower} = ${DS}this->createBuilder()->setRecord(${DS}record[0])->build();
            } else {
                throw (new Exception())->setCode(Exception::CODE_MULTIPLE_RECORDS_RETRIEVED);
            }
        } else {
            throw (new Exception())->setCode(Exception::CODE_NO_DATA_LOADED);
        }

        return ${DS}${daoLower};
    }

    public function getMap(): MapInterface
    {
        // Use Doctrine Connection Decorator Repository to retrieve your DAOs from storage
        // Optionally by a strongly typed criteria object.
        ${DS}records = ${DS}this->getNewQueryBuilder()->execute()->fetchAll();
        ${DS}${daoLower}s = [];
        foreach (${DS}records as ${DS}record) {
            ${DS}${daoLower} = ${DS}this->createBuilder()->setRecord(${DS}record)->build();
            ${DS}${daoLower}s[${DS}body->getId()] = ${DS}${daoLower};
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
            throw new \LogicException("${daoUpper} with ID[${DS}] is already attached.");
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

    protected function getNewQueryBuilder(): QueryBuilder
    {
        ${DS}doctrineConnectionDecoratorRepository = ${DS}this->getDoctrineDBALConnectionDecoratorRepository();
        ${DS}queryBuilder = ${DS}doctrineConnectionDecoratorRepository->createQueryBuilder(DecoratorInterface::ID_CORE);

        return ${DS}queryBuilder->from(${daoUpper}Interface::TABLE_NAME)->select('*');
    }
}