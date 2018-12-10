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
    /** @var string */
    protected $daoNamespace;

    public function build() : BuildConfigurationInterface
    {
        $buildConfiguration = $this->getBuildConfigurationFactory()->create();
        $configArray = $this->getConfigFromYaml();

        $buildConfiguration->setTableName($configArray['dao']['table_name'])
            ->setDaoIdentityField($configArray['dao']['identity_field'])
            ->setHttpRoute($configArray['dao']['http_route'])
            ->setShouldUseConditionalSettersInDAOBuilder(
                $configArray['dao']['should_use_conditional_setters_in_dao_builder'] ?? false
            )
            ->setRootSaveLocation($this->getFabDirFromYamlPath())
            ->setProjectDir($this->getProjectDirFromYamlPath())
            ->setProjectName($this->getProjectName());

        print_r($buildConfiguration);

        die();

        foreach ($configArray['dao']['properties'] as $key => $values) {
            $buildConfiguration->appendDaoProperty($key, $values);
        }

        return $buildConfiguration;
    }

    protected function getFabDirFromYamlPath() : string
    {
        // Explode and remove the vendor portion of the filepath. Replace src/ with fab/
        $pathArray = explode('vendor', $this->getYamlFilePath());
        $path = $pathArray[0] . 'fab/' . array_slice(explode('src/', $pathArray[1]), -1)[0];

        return $path;
    }

    protected function getProjectDirFromYamlPath() : string
    {
        return explode('vendor/', $this->getYamlFilePath())[0];
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
}
