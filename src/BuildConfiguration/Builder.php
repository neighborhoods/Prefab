<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration;


use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\BuildConfiguration;
use Symfony\Component\Yaml\Yaml;

class Builder implements BuilderInterface
{
    use BuildConfiguration\Factory\AwareTrait;

    protected $yamlFilePath;
    protected $projectName;
    protected $daoNamespace;
    protected $projectRoot;

    public function build() : BuildConfigurationInterface
    {
        $buildConfiguration = $this->getBuildConfigurationFactory()->create();
        $configArray = $this->getConfigFromYaml();

        $buildConfiguration->setTableName($configArray['dao']['table_name'])
            ->setDaoIdentityField($configArray['dao']['identity_field'])
            ->setRootSaveLocation($this->getFabDirFromYamlPath())
            ->setProjectDir($this->getProjectRoot())
            ->setProjectName($this->getProjectName());

        if (!empty($configArray['dao']['http_route'])) {
            $buildConfiguration->setHttpRoute($configArray['dao']['http_route']);
            $httpVerbs = ($configArray['dao']['http_verbs']) ?? ['GET'];
            $buildConfiguration->setHttpVerbs($httpVerbs);
        }

        if (!empty($configArray['dao']['supporting_actor_group'])) {
            $buildConfiguration->setSupportingActorGroup($configArray['dao']['supporting_actor_group']);
        }

        foreach ($configArray['dao']['properties'] as $key => $values) {
            $buildConfiguration->appendDaoProperty($key, $values);
        }

        return $buildConfiguration;
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

}
