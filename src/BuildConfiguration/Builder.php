<?php

namespace Neighborhoods\Prefab\BuildConfiguration;


use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\BuildConfiguration;
use Symfony\Component\Yaml\Yaml;

class Builder implements BuilderInterface
{
    use BuildConfiguration\Factory\AwareTrait;

    protected $yamlFilePath;
    protected $daoFileLocation;

    public function build() : BuildConfigurationInterface
    {
        $buildConfiguration = $this->getBuildConfigurationFactory()->create();
        $configArray = $this->getConfigFromYaml();

        $buildConfiguration->setDaoName($configArray['dao']['name'])
            ->setTableName($configArray['dao']['table_name'])
            ->setDaoIdentityField($configArray['dao']['identity_field'])
            ->setDaoFileLocation($this->getDaoFileLocation());

        foreach ($configArray['dao']['properties'] as $key => $values) {
            $buildConfiguration->appendDaoProperty($key, $values);
        }

        return $buildConfiguration;
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

    protected function getDaoFileLocation()
    {
        if ($this->daoFileLocation === null) {
            throw new \LogicException('Builder projectDirectory has not been set.');
        }
        return $this->daoFileLocation;
    }

    public function setDaoFileLocation($daoFileLocation) : BuilderInterface
    {
        if ($this->daoFileLocation !== null) {
            throw new \LogicException('Builder projectDirectory is already set.');
        }
        $this->daoFileLocation = $daoFileLocation;
        return $this;
    }

}
