<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

class BuildConfiguration implements BuildConfigurationInterface
{
    protected $tableName;
    protected $daoIdentityField;
    protected $daoName;
    protected $daoPropertyMap;
    protected $rootSaveLocation;
    protected $vendorName;
    protected $projectName;
    protected $httpRoute;
    protected $httpVerbs;
    protected $projectDir;
    protected $supportingActorGroup;
    protected $actorNamespace;
    protected $constantMap;

     public function getTableName(): string
     {
         if ($this->tableName === null) {
             throw new \LogicException('tableName has not been set');
         }
         
         return $this->tableName;
     }
     
     public function setTableName(string $tableName): BuildConfigurationInterface
     {
         if ($this->tableName !== null) {
             throw new \LogicException('tableName has already been set');
         }
         
         $this->tableName = $tableName;
         
         return $this;
     }

     public function getDaoIdentityField(): string
     {
         if ($this->daoIdentityField === null) {
             throw new \LogicException('daoIdentityField has not been set');
         }
         
         return $this->daoIdentityField;
     }
     
     public function setDaoIdentityField(string $daoIdentityField): BuildConfigurationInterface
     {
         if ($this->daoIdentityField !== null) {
             throw new \LogicException('daoIdentityField has already been set');
         }
         
         $this->daoIdentityField = $daoIdentityField;
         
         return $this;
     }

     public function getRootSaveLocation(): string
     {
         if ($this->rootSaveLocation === null) {
             throw new \LogicException('rootSaveLocation has not been set');
         }
         
         return $this->rootSaveLocation;
     }
     
     public function setRootSaveLocation(string $rootSaveLocation): BuildConfigurationInterface
     {
         if ($this->rootSaveLocation !== null) {
             throw new \LogicException('rootSaveLocation has already been set');
         }
         
         $this->rootSaveLocation = $rootSaveLocation;
         
         return $this;
     }

     public function getProjectName(): string
     {
         if ($this->projectName === null) {
             throw new \LogicException('projectName has not been set');
         }
         
         return $this->projectName;
     }
     
     public function setProjectName(string $projectName): BuildConfigurationInterface
     {
         if ($this->projectName !== null) {
             throw new \LogicException('projectName has already been set');
         }
         
         $this->projectName = $projectName;
         
         return $this;
     }

     public function getHttpRoute(): string
     {
         if ($this->httpRoute === null) {
             throw new \LogicException('httpRoute has not been set');
         }
         
         return $this->httpRoute;
     }
     
     public function setHttpRoute(string $httpRoute): BuildConfigurationInterface
     {
         if ($this->httpRoute !== null) {
             throw new \LogicException('httpRoute has already been set');
         }
         
         $this->httpRoute = $httpRoute;
         
         return $this;
     }

     public function getHttpVerbs(): array
     {
         if ($this->httpVerbs === null) {
             throw new \LogicException('httpVerbs has not been set');
         }
         
         return $this->httpVerbs;
     }
     
     public function setHttpVerbs(array $httpVerbs): BuildConfigurationInterface
     {
         if ($this->httpVerbs !== null) {
             throw new \LogicException('httpVerbs has already been set');
         }
         
         $this->httpVerbs = $httpVerbs;
         
         return $this;
     }

     public function getProjectDir(): string
     {
         if ($this->projectDir === null) {
             throw new \LogicException('projectDir has not been set');
         }
         
         return $this->projectDir;
     }
     
     public function setProjectDir(string $projectDir): BuildConfigurationInterface
     {
         if ($this->projectDir !== null) {
             throw new \LogicException('projectDir has already been set');
         }
         
         $this->projectDir = $projectDir;
         
         return $this;
     }

    public function hasDaoIdentityField() : bool
    {
        return $this->daoIdentityField !== null;
    }

    public function hasHttpRoute() : bool
    {
        return $this->httpRoute !== null;
    }

    public function hasHttpVerbs() : bool
    {
        return $this->httpVerbs !== null;
    }

    public function getSupportingActorGroup() : string
    {
        if ($this->supportingActorGroup === null) {
            throw new \LogicException('BuildConfiguration supportingActorGroup has not been set.');
        }
        return $this->supportingActorGroup;
    }

    public function setSupportingActorGroup(string $supportingActorGroup) : BuildConfigurationInterface
    {
        if ($this->supportingActorGroup !== null) {
            throw new \LogicException('BuildConfiguration supportingActorGroup is already set.');
        }
        $this->supportingActorGroup = $supportingActorGroup;
        return $this;
    }

    public function hasSupportingActorGroup() : bool
    {
        return $this->supportingActorGroup !== null;
    }

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

    public function hasDaoName() : bool
    {
        return $this->daoName !== null;
    }

    public function getActorNamespace() : string
    {
        if ($this->actorNamespace === null) {
            throw new \LogicException('BuildConfiguration actorNamespace has not been set.');
        }
        return $this->actorNamespace;
    }

    public function setActorNamespace(string $actorNamespace) : BuildConfigurationInterface
    {
        if ($this->actorNamespace !== null) {
            throw new \LogicException('BuildConfiguration actorNamespace is already set.');
        }
        $this->actorNamespace = $actorNamespace;
        return $this;
    }

    public function hasActorNamespace() : bool
    {
        return $this->actorNamespace !== null;
    }

    public function getVendorName() : string
    {
        if ($this->vendorName === null) {
            throw new \LogicException('BuildConfiguration vendorName has not been set.');
        }
        return $this->vendorName;
    }

    public function setVendorName(string $vendorName) : BuildConfigurationInterface
    {
        if ($this->vendorName !== null) {
            throw new \LogicException('BuildConfiguration vendorName is already set.');
        }
        $this->vendorName = $vendorName;
        return $this;
    }

    public function hasVendorName() : bool
    {
        return $this->vendorName !== null;
    }

    public function getConstantMap(): \Neighborhoods\Prefab\Constant\MapInterface
    {
        if ($this->constantMap === null) {
            throw new \LogicException('constantMap has not been set');
        }

        return $this->constantMap;
    }

    public function setConstantMap(\Neighborhoods\Prefab\Constant\MapInterface $constantMap): BuildConfigurationInterface
    {
        if ($this->constantMap !== null) {
            throw new \LogicException('constantMap has already been set');
        }

        $this->constantMap = $constantMap;
        return $this;
    }

    public function hasConstantMap(): bool
    {
        return $this->constantMap !== null;
    }

    public function getDaoPropertyMap() : \Neighborhoods\Prefab\DaoProperty\MapInterface
    {
        if ($this->daoPropertyMap === null) {
            throw new \LogicException('daoPropertyMap has not been set');
        }

        return $this->daoPropertyMap;
    }

    public function setDaoPropertyMap(DaoProperty\MapInterface $daoPropertyMap) : BuildConfigurationInterface
    {
        if ($this->daoPropertyMap !== null) {
            throw new \LogicException('daoPropertyMap has already been set');
        }

        $this->daoPropertyMap = $daoPropertyMap;
        return $this;
    }

    public function hasDaoPropertyMap() : bool
    {
        return $this->daoPropertyMap !== null;
    }
}
