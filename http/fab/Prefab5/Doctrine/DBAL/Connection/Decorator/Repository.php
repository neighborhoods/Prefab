<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\Decorator;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Doctrine\DBAL\Schema\Schema;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\DecoratorInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine;

class Repository implements RepositoryInterface
{
    use Doctrine\DBAL\Connection\Decorator\Map\AwareTrait;
    use Doctrine\DBAL\Connection\Decorator\Factory\AwareTrait;

    public function create(string $id): RepositoryInterface
    {
        if (isset($this->getDoctrineDBALConnectionDecoratorMap()[$id])) {
            throw new \LogicException("Decorator with ID[$id] is already set.");
        } else {
            $connectionDecorator = $this->getDoctrineDBALConnectionDecoratorFactory()->create()->setId($id);
            $this->getDoctrineDBALConnectionDecoratorMap()[$id] = $connectionDecorator;
        }

        return $this;
    }

    public function has(string $id) : bool
    {
        return isset($this->getDoctrineDBALConnectionDecoratorMap()[$id]);
    }

    public function get(string $id): DecoratorInterface
    {
        if (!isset($this->getDoctrineDBALConnectionDecoratorMap()[$id])) {
            throw new \LogicException("Decorator with ID[$id] is not set.");
        }

        return $this->getDoctrineDBALConnectionDecoratorMap()[$id];
    }

    public function getConnection(string $id): Connection
    {
        return $this->get($id)->getDoctrineConnection();
    }

    public function createQueryBuilder(string $id): QueryBuilder
    {
        return $this->getConnection($id)->createQueryBuilder();
    }

    public function getSchemaManager(string $id): AbstractSchemaManager
    {
        return $this->getConnection($id)->getSchemaManager();
    }

    public function createSchema(string $id): Schema
    {
        return $this->getSchemaManager($id)->createSchema();
    }

    public function attach(DecoratorInterface $decorator): RepositoryInterface
    {
        $id = $decorator->getId();
        if (isset($this->getDoctrineDBALConnectionDecoratorMap()[$id])) {
            throw new \LogicException("Decorator with ID[$id] is already set.");
        }
        $this->getDoctrineDBALConnectionDecoratorMap()[$id] = $decorator;

        return $this;
    }
}
