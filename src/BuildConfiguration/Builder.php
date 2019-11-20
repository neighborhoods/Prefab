<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration;

use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\BuildConfiguration;
use Symfony\Component\Yaml\Yaml;
use Neighborhoods\Prefab\DaoProperty;
use Neighborhoods\Prefab\Constant;

class Builder implements BuilderInterface
{
    use BuildConfiguration\Factory\AwareTrait;
    use DaoProperty\Builder\Factory\AwareTrait;
    use DaoProperty\Map\Factory\AwareTrait;
    use Constant\Factory\AwareTrait;
    use Constant\Map\Factory\AwareTrait;

    protected $yamlFilePath;
    protected $vendorName;
    protected $projectName;
    protected $projectRoot;

    public function build() : BuildConfigurationInterface
    {
        $buildConfiguration = $this->getBuildConfigurationFactory()->create();
        $prefabDefinitionFileArray = $this->getConfigFromYaml();

        if (isset($prefabDefinitionFileArray[BuildConfigurationInterface::KEY_DAO])) {
            $prefabDefinitionFileArray = $prefabDefinitionFileArray[BuildConfigurationInterface::KEY_DAO];
        }
        
        $buildConfiguration->setTableName($prefabDefinitionFileArray[BuildConfigurationInterface::KEY_TABLE_NAME])
            ->setRootSaveLocation($this->getFabDirFromYamlPath())
            ->setProjectDir($this->getProjectRoot())
            ->setVendorName($this->getVendorName())
            ->setProjectName($this->getProjectName());

        $buildConfiguration->setDaoName($this->getActorNameFromFilepath());
        $buildConfiguration->setActorNamespace($this->buildActorNamespace());

        if (!empty($prefabDefinitionFileArray[BuildConfigurationInterface::KEY_IDENTITY_FIELD])) {
            $buildConfiguration->setDaoIdentityField($prefabDefinitionFileArray[BuildConfigurationInterface::KEY_IDENTITY_FIELD]);
        }

        if (!empty($prefabDefinitionFileArray[BuildConfigurationInterface::KEY_HTTP_ROUTE])) {
            $buildConfiguration->setHttpRoute($prefabDefinitionFileArray[BuildConfigurationInterface::KEY_HTTP_ROUTE]);
            $httpVerbs = ($prefabDefinitionFileArray[BuildConfigurationInterface::KEY_HTTP_VERBS]) ?? [BuildConfigurationInterface::HTTP_VERB_GET];
            $buildConfiguration->setHttpVerbs($httpVerbs);
        }

        if (!empty($prefabDefinitionFileArray[BuildConfigurationInterface::KEY_SUPPORTING_ACTOR_GROUP])) {
            $buildConfiguration->setSupportingActorGroup($prefabDefinitionFileArray[BuildConfigurationInterface::KEY_SUPPORTING_ACTOR_GROUP]);
        } else {
            $buildConfiguration->setSupportingActorGroup(BuildConfigurationInterface::SUPPORTING_ACTOR_GROUP_COMPLETE);
        }

        $daoPropertyMap = $this->getDaoPropertyMapFactory()->create();
        foreach ($prefabDefinitionFileArray[BuildConfigurationInterface::KEY_PROPERTIES] as $key => $values) {
            $record = $values;
            $record[BuildConfigurationInterface::KEY_NAME] = $key;

            $daoPropertyMap->append(
                $this->getDaoPropertyBuilderFactory()->create()
                    ->setRecord($record)
                    ->build()
            );
        }

        $buildConfiguration->setDaoPropertyMap($daoPropertyMap);

        if (isset($prefabDefinitionFileArray[BuildConfigurationInterface::KEY_CONSTANTS])) {
            $constantMap = $this->getConstantMapFactory()->create();
            foreach ($prefabDefinitionFileArray[BuildConfigurationInterface::KEY_CONSTANTS] as $name => $value) {
                $constant = $this->getConstantFactory()->create()
                    ->setName($name)
                    ->setValue($value);
                $constantMap->append($constant);
            }

            $buildConfiguration->setConstantMap($constantMap);
        }

        return $buildConfiguration;
    }

    protected function buildActorNamespace() : string
    {
        $filepath = explode('/src/', $this->getYamlFilePath())[1];
        $filepath = str_replace(BuildConfigurationInterface::PREFAB_DEFINITION_FILE_EXTENSION, '', $filepath);
        $filepathArray = explode('/', $filepath);
        array_pop($filepathArray);
        $truncatedFilepath = implode('\\', $filepathArray);

        return $this->getVendorName() . '\\' . $this->getProjectName() . '\\' . $truncatedFilepath;
    }

    protected function getActorNameFromFilepath() : string
    {
        $filepathArray = explode('/', $this->getYamlFilePath());
        $filename = array_pop($filepathArray);
        return str_replace(BuildConfigurationInterface::PREFAB_DEFINITION_FILE_EXTENSION, '', $filename);
    }

    protected function getFabDirFromYamlPath() : string
    {
        return str_replace('/src/', '/fab/', $this->getYamlFilePath());
    }

    protected function getConfigFromYaml() : array
    {
        return Yaml::parseFile($this->getYamlFilePath());
    }

    protected function getYamlFilePath() : string
    {
        if ($this->yamlFilePath === null) {
            throw new \LogicException('Builder yamlFilePath has not been set.');
        }
        return $this->yamlFilePath;
    }

    public function setYamlFilePath(string $yamlFilePath) : BuilderInterface
    {
        if ($this->yamlFilePath !== null) {
            throw new \LogicException('Builder yamlFilePath is already set.');
        }
        $this->yamlFilePath = $yamlFilePath;
        return $this;
    }

    protected function getProjectName() : string
    {
        if ($this->projectName === null) {
            throw new \LogicException('Builder projectName has not been set.');
        }
        return $this->projectName;
    }

    public function setProjectName(string $projectName) : BuilderInterface
    {
        if ($this->projectName !== null) {
            throw new \LogicException('Builder projectName is already set.');
        }
        $this->projectName = $projectName;
        return $this;
    }

    protected function getProjectRoot() : string
    {
        if ($this->projectRoot === null) {
            throw new \LogicException('Builder projectRoot has not been set.');
        }
        return $this->projectRoot;
    }

    public function setProjectRoot(string $projectRoot) : BuilderInterface
    {
        if ($this->projectRoot !== null) {
            throw new \LogicException('Builder projectRoot is already set.');
        }
        $this->projectRoot = $projectRoot;
        return $this;
    }

    protected function getVendorName() : string
    {
        if ($this->vendorName === null) {
            throw new \LogicException('Builder vendorName has not been set.');
        }
        return $this->vendorName;
    }

    public function setVendorName(string $vendorName) : BuilderInterface
    {
        if ($this->vendorName !== null) {
            throw new \LogicException('Builder vendorName is already set.');
        }
        $this->vendorName = $vendorName;
        return $this;
    }
}
