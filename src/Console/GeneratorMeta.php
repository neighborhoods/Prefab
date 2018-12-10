<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console;

class GeneratorMeta implements GeneratorMetaInterface
{

    protected $actorNamespace;
    protected $actorFilePath;
    protected $daoName;
    protected $daoProperties;
    protected $tableName;
    protected $daoString;
    protected $daoIdentityField;
    protected $httpRoute;
    protected $shouldUseConditionalSetters;

    public function getDaoProperties() : array
    {
        if ($this->daoProperties === null) {
            throw new \LogicException('GeneratorMeta daoProperties has not been set.');
        }
        return $this->daoProperties;
    }

    public function setDaoProperties(array $daoProperties) : GeneratorMetaInterface
    {
        if ($this->daoProperties !== null) {
            throw new \LogicException('GeneratorMeta daoProperties is already set.');
        }
        $this->daoProperties = $daoProperties;
        return $this;
    }

    public function getActorNamespace(): string
    {
        if ($this->actorNamespace === null) {
            throw new \LogicException('GeneratorMeta actorNamespace has not been set.');
        }
        return $this->actorNamespace;
    }

    public function setActorNamespace(string $actorNamespace): GeneratorMetaInterface
    {
        if ($this->actorNamespace !== null) {
            throw new \LogicException('GeneratorMeta actorNamespace is already set.');
        }
        $this->actorNamespace = $actorNamespace;
        return $this;
    }

    public function getActorFilePath(): string
    {
        if ($this->actorFilePath === null) {
            throw new \LogicException('GeneratorMeta actorFilePath has not been set.');
        }
        return $this->actorFilePath;
    }

    public function setActorFilePath(string $actorFilePath): GeneratorMetaInterface
    {
        if ($this->actorFilePath !== null) {
            throw new \LogicException('GeneratorMeta actorFilePath is already set.');
        }
        $this->actorFilePath = $actorFilePath;
        return $this;
    }

    public function getDaoName(): string
    {
        if ($this->daoName === null) {
            throw new \LogicException('GeneratorMeta daoName has not been set.');
        }
        return $this->daoName;
    }

    public function setDaoName(string $daoName): GeneratorMetaInterface
    {
        if ($this->daoName !== null) {
            throw new \LogicException('GeneratorMeta daoName is already set.');
        }
        $this->daoName = $daoName;
        return $this;
    }

    public function getTableName() : string
    {
        if ($this->tableName === null) {
            throw new \LogicException('GeneratorMeta tableName has not been set.');
        }
        return $this->tableName;
    }

    public function setTableName(string $tableName) : GeneratorMetaInterface
    {
        if ($this->tableName !== null) {
            throw new \LogicException('GeneratorMeta tableName is already set.');
        }
        $this->tableName = $tableName;
        return $this;
    }

    public function getDaoString() : string
    {
        if ($this->daoString === null) {
            throw new \LogicException('GeneratorMeta daoString has not been set.');
        }
        return $this->daoString;
    }

    public function setDaoString(string $daoString) : GeneratorMetaInterface
    {
        if ($this->daoString !== null) {
            throw new \LogicException('GeneratorMeta daoString is already set.');
        }
        $this->daoString = $daoString;
        return $this;
    }

    public function getDaoIdentityField() : string
    {
        if ($this->daoIdentityField === null) {
            throw new \LogicException('GeneratorMeta daoIdentityField has not been set.');
        }
        return $this->daoIdentityField;
    }

    public function setDaoIdentityField(string $daoIdentityField) : GeneratorMetaInterface
    {
        if ($this->daoIdentityField !== null) {
            throw new \LogicException('GeneratorMeta daoIdentityField is already set.');
        }
        $this->daoIdentityField = $daoIdentityField;
        return $this;
    }

    public function getHttpRoute() : string
    {
        if ($this->httpRoute === null) {
            throw new \LogicException('GeneratorMeta httpRoute has not been set.');
        }
        return $this->httpRoute;
    }

    public function setHttpRoute(string $httpRoute) : GeneratorMetaInterface
    {
        if ($this->httpRoute !== null) {
            throw new \LogicException('GeneratorMeta httpRoute is already set.');
        }
        $this->httpRoute = $httpRoute;
        return $this;
    }

    public function setShouldUseConditionalSetters(
        bool $shouldUseConditionalSetters
    ) : GeneratorMetaInterface {
        if ($this->shouldUseConditionalSetters !== null) {
            throw new \LogicException('GeneratorMeta shouldUseConditionalSetters is already set.');
        }
        $this->shouldUseConditionalSetters = $shouldUseConditionalSetters;
        return $this;
    }

    public function getShouldUseConditionalSetters() : bool
    {
        if ($this->shouldUseConditionalSetters === null) {
            return false;
        }
        return (bool) $this->shouldUseConditionalSetters;
    }
}
