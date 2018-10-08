<?php

namespace Neighborhoods\Prefab;

interface BuildConfigurationInterface
{
    public function getDaoName() : string;

    public function setDaoName(string $daoName) : BuildConfigurationInterface;

    public function getTableName() : string;

    public function setTableName(string $tableName) : BuildConfigurationInterface;

    public function getDaoIdentityField() : string;

    public function setDaoIdentityField(string $daoIdentityField) : BuildConfigurationInterface;

    public function getDaoProperties() : array;

    public function appendDaoProperty(array $daoProperty) : BuildConfigurationInterface;
}
