<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

class BuildConfiguration implements BuildConfigurationInterface
{
    /** @var string */
    private $tableName;

    /** @var string */
    private $daoIdentityField;

    /** @var array */
    private $daoProperties;

    /** @var string */
    private $rootSaveLocation;

    /** @var string */
    private $projectName;

    /** @var string */
    private $httpRoute;

    /** @var array */
    private $httpVerbs;

    /** @var string */
    private $projectDir;

    /** @var string */
    private $supportingBuildConfigurationGroup;

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

     public function getDaoProperties(): array
     {
         if ($this->daoProperties === null) {
             throw new \LogicException('daoProperties has not been set');
         }
         
         return $this->daoProperties;
     }
     
     public function setDaoProperties(array $daoProperties): BuildConfigurationInterface
     {
         if ($this->daoProperties !== null) {
             throw new \LogicException('daoProperties has already been set');
         }
         
         $this->daoProperties = $daoProperties;
         
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

     public function getSupportingBuildConfigurationGroup(): string
     {
         if ($this->supportingBuildConfigurationGroup === null) {
             throw new \LogicException('supportingBuildConfigurationGroup has not been set');
         }
         
         return $this->supportingBuildConfigurationGroup;
     }
     
     public function setSupportingBuildConfigurationGroup(string $supportingBuildConfigurationGroup): BuildConfigurationInterface
     {
         if ($this->supportingBuildConfigurationGroup !== null) {
             throw new \LogicException('supportingBuildConfigurationGroup has already been set');
         }
         
         $this->supportingBuildConfigurationGroup = $supportingBuildConfigurationGroup;
         
         return $this;
     }
}
