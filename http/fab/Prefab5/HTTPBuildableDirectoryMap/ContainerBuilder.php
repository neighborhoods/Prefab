<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap;

use LogicException;
use Psr\Container\ContainerInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\InvalidDirectory;
use Symfony\Component\DependencyInjection\Dumper\YamlDumper;
use Zend\Expressive\Application;

class ContainerBuilder implements ContainerBuilderInterface
{
    protected $buildableDirectoryMap;
    protected $directoryGroup;
    protected $rootDirectoryPath;

    public function build() : ContainerInterface
    {
        $directoryGroup = $this->getDirectoryGroup();
        $directoryGroupRoot = explode('/', $directoryGroup)[0];

        $filesystemProperties = new FilesystemProperties();
        $filesystemProperties->setRootDirectoryPath($this->getRootDirectoryPath());

        if (
            !isset($this->getBuildableDirectoryMap()[$directoryGroup])
            && !isset($this->getBuildableDirectoryMap()[$directoryGroupRoot])
        ) {
            throw (new InvalidDirectory\Exception)->setCode(InvalidDirectory\Exception::CODE_INVALID_DIRECTORY);
        }

        $routeBuildableDirectories =
            $this->getBuildableDirectoryMap()[$directoryGroup] ??
            $this->getBuildableDirectoryMap()[$directoryGroupRoot];

        $discoverableDirectories = (new DiscoverableDirectories\Builder())
            ->setDirectoryGroup($directoryGroup)
            ->setRecord($routeBuildableDirectories)
            ->build();
        $discoverableDirectories->setProteanContainerBuilderFilesystemProperties(
            $filesystemProperties
        );
        $discoverableDirectories->appendPath($this->buildZendExpressive($filesystemProperties));

        $containerName = 'HTTP';
        if ($directoryGroup !== '') {
            $containerName = 'HTTP_' . str_replace(['/', '-'], '_', $directoryGroup);
        }
        $proteanContainerBuilder = new Protean\Container\Builder();
        $proteanContainerBuilder->setContainerName($containerName);
        $proteanContainerBuilder->setFilesystemProperties($filesystemProperties);
        $proteanContainerBuilder->setDiscoverableDirectories($discoverableDirectories);

        return $proteanContainerBuilder->build();
    }

    public function buildZendExpressive(FilesystemPropertiesInterface $filesystemProperties): string
    {
        $currentWorkingDirectory = getcwd();
        chdir($filesystemProperties->getRootDirectoryPath());
        /** @noinspection PhpIncludeInspection */
        $zendContainerBuilder = require $filesystemProperties->getZendConfigContainerFilePath();
        $applicationServiceDefinition = $zendContainerBuilder->findDefinition(Application::class);
        /** @noinspection PhpIncludeInspection */
        (require $filesystemProperties->getPipelineFilePath())($applicationServiceDefinition);
        file_put_contents(
            $filesystemProperties->getExpressiveDIYAMLFilePath(),
            (new YamlDumper($zendContainerBuilder))->dump()
        );
        chdir($currentWorkingDirectory);
        return $filesystemProperties->getZendCacheDirectoryPath();
    }

    public function setRootDirectoryPath(string $rootDirectoryPath): ContainerBuilderInterface
    {
        if (isset($this->rootDirectoryPath)) {
            throw new LogicException('Root Directory Path is already set.');
        }
        $this->rootDirectoryPath = $rootDirectoryPath;
        return $this;
    }

    protected function getBuildableDirectoryMap() : array
    {
        if ($this->buildableDirectoryMap === null) {
            throw new LogicException('ContainerBuilder buildableDirectoryMap has not been set.');
        }
        return $this->buildableDirectoryMap;
    }

    public function setBuildableDirectoryMap(array $buildableDirectoryMap) : ContainerBuilderInterface
    {
        if ($this->buildableDirectoryMap !== null) {
            throw new LogicException('ContainerBuilder buildableDirectoryMap is already set.');
        }
        $this->buildableDirectoryMap = $buildableDirectoryMap;
        return $this;
    }

    public function getDirectoryGroup() : string
    {
        if ($this->directoryGroup === null) {
            throw new LogicException('ContainerBuilder directoryGroup has not been set.');
        }
        return $this->directoryGroup;
    }

    public function setDirectoryGroup(string $directoryGroup) : ContainerBuilderInterface
    {
        if ($this->directoryGroup !== null) {
            throw new LogicException('ContainerBuilder directoryGroup is already set.');
        }
        $this->directoryGroup = $directoryGroup;
        return $this;
    }

    private function getRootDirectoryPath(): string
    {
        if (!isset($this->rootDirectoryPath)) {
            throw new LogicException('Root Directory Path has not been set.');
        }
        return $this->rootDirectoryPath;
    }

}
