<?php

namespace Neighborhoods\Prefab;


class BuildConfiguration implements BuildConfigurationInterface
{
    /** @var string */
    protected $daoName;
    /** @var string */
    protected $tableName;
    /** @var string */
    protected $daoIdentityField;
    // TODO: Make this a map instead of an array.
    protected $daoProperties = [];

    public function getDaoName() : string
    {
        if ($this->daoName === null) {
            throw new \LogicException('BuildConfiguration daoName has not been set.');
        }
        return $this->daoName;
    }

    public function setDaoName(string $daoName) : BuildConfigurationInterface
    {
        if ($this->daoName !== null) {
            throw new \LogicException('BuildConfiguration daoName is already set.');
        }
        $this->daoName = $daoName;
        return $this;
    }

    public function getTableName() : string
    {
        if ($this->tableName === null) {
            throw new \LogicException('BuildConfiguration tableName has not been set.');
        }
        return $this->tableName;
    }

    public function setTableName(string $tableName) : BuildConfigurationInterface
    {
        if ($this->tableName !== null) {
            throw new \LogicException('BuildConfiguration tableName is already set.');
        }
        $this->tableName = $tableName;
        return $this;
    }

    public function getDaoIdentityField() : string
    {
        if ($this->daoIdentityField === null) {
            throw new \LogicException('BuildConfiguration daoIdentityField has not been set.');
        }
        return $this->daoIdentityField;
    }

    public function setDaoIdentityField(string $daoIdentityField) : BuildConfigurationInterface
    {
        if ($this->daoIdentityField !== null) {
            throw new \LogicException('BuildConfiguration daoIdentityField is already set.');
        }
        $this->daoIdentityField = $daoIdentityField;
        return $this;
    }

    public function getDaoProperties() : array
    {
        if ($this->daoProperties === null) {
            throw new \LogicException('BuildConfiguration daoProperties has not been set.');
        }
        return $this->daoProperties;
    }

    // TODO: Make this a property object instead of an array
    public function appendDaoProperty(array $daoProperty) : BuildConfigurationInterface
    {
        if ($this->daoProperties !== null) {
            throw new \LogicException('BuildConfiguration daoProperties is already set.');
        }
        $this->daoProperties[] = $daoProperty;
        return $this;
    }
}
