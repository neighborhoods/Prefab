<?php

declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\Decorator;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Doctrine\DBAL\Schema\Schema;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\DecoratorInterface;

interface RepositoryInterface
{
    public function create(string $id): RepositoryInterface;

    public function has(string $id): bool;

    public function get(string $id): DecoratorInterface;

    public function getConnection(string $id): Connection;

    public function attach(DecoratorInterface $decorator): RepositoryInterface;

    public function createQueryBuilder(string $id): QueryBuilder;

    public function createSchema(string $id): Schema;

    public function getSchemaManager(string $id): AbstractSchemaManager;
}
