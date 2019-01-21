<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console;

interface GeneratorMetaInterface
{
    public function getActorNamespace() : string;

    public function setActorNamespace(string $actorNamespace) : GeneratorMetaInterface;

    public function getActorFilePath() : string;

    public function setActorFilePath(string $actorFilePath) : GeneratorMetaInterface;

    public function getDaoName() : string;

    public function setDaoName(string $daoName) : GeneratorMetaInterface;

    public function getDaoProperties() : array;

    public function setDaoProperties(array $daoProperties) : GeneratorMetaInterface;

    public function getTableName() : string;

    public function setTableName(string $tableName) : GeneratorMetaInterface;

    public function getDaoString() : string;

    public function setDaoString(string $daoString) : GeneratorMetaInterface;

    public function getDaoIdentityField() : string;

    public function setDaoIdentityField(string $daoIdentityField) : GeneratorMetaInterface;

    public function getHttpRoute() : string;

    public function setHttpRoute(string $httpRoute) : GeneratorMetaInterface;

    public function hasHttpRoute() : bool;
}
