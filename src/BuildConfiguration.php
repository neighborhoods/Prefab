<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;


class BuildConfiguration implements BuildConfigurationInterface
{
    protected $tableName;
    protected $daoIdentityField;
    // TODO: Make this a map instead of an array.
    protected $daoProperties = [];
    protected $rootSaveLocation;
    protected $projectName;
    protected $httpRoute;

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

    // TODO: Make this a property object instead of a key and array
    public function appendDaoProperty(string $propertyName, array $values) : BuildConfigurationInterface
    {
        $this->daoProperties[$propertyName] = $values;
        return $this;
    }

    public function getRootSaveLocation() : string
    {
        if ($this->rootSaveLocation === null) {
            throw new \LogicException('BuildConfiguration projectDirectory has not been set.');
        }
        return $this->rootSaveLocation;
    }

    public function setRootSaveLocation(string $rootSaveLocation) : BuildConfigurationInterface
    {
        if ($this->rootSaveLocation !== null) {
            throw new \LogicException('BuildConfiguration projectDirectory is already set.');
        }
        $this->rootSaveLocation = $rootSaveLocation;
        return $this;
    }

    public function getProjectName() : string
    {
        if ($this->projectName === null) {
            throw new \LogicException('BuildConfiguration projectName has not been set.');
        }
        return $this->projectName;
    }

    public function setProjectName(string $projectName) : BuildConfigurationInterface
    {
        if ($this->projectName !== null) {
            throw new \LogicException('BuildConfiguration projectName is already set.');
        }
        $this->projectName = $projectName;
        return $this;
    }

    public function getHttpRoute() : string
    {
        if ($this->httpRoute === null) {
            throw new \LogicException('BuildConfiguration httpRoute has not been set.');
        }
        return $this->httpRoute;
    }

    public function setHttpRoute(string $httpRoute) : BuildConfigurationInterface
    {
        if ($this->httpRoute !== null) {
            throw new \LogicException('BuildConfiguration httpRoute is already set.');
        }
        $this->httpRoute = $httpRoute;
        return $this;
    }
}
