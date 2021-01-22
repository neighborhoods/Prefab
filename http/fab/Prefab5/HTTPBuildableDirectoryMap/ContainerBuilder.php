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

        $cacheHandler = (new \Neighborhoods\DependencyInjectionContainerBuilderComponent\SymfonyConfigCacheHandler\Builder())
            ->setName($containerName)
            ->setCacheDirPath($filesystemProperties->getCacheDirectoryPath())
            ->setDebug(false)
            ->build();

        $containerBuilder = (new \Neighborhoods\DependencyInjectionContainerBuilderComponent\TinyContainerBuilder())
            ->setContainerBuilder(new \Symfony\Component\DependencyInjection\ContainerBuilder())
            ->setRootPath($filesystemProperties->getRootDirectoryPath())
            ->setCacheHandler($cacheHandler)
            ->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\AnalyzeServiceReferencesPass())
            ->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\InlineServiceDefinitionsPass());

        $paths = $this->getFullPaths($discoverableDirectories);
        foreach ($paths as $path) {
            $containerBuilder->addSourcePath($path);
        }
        return $containerBuilder->build();
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

    protected function getFullPaths(DiscoverableDirectoriesInterface $discoverableDirectories): array
    {
        $filesystem = new Filesystem();
        $filesystemProperties = $this->getFilesystemProperties();
        $fullPaths = [];
        foreach ($discoverableDirectories->getAppendedPaths() as $appendedPath) {
            $fullPaths[] = $filesystemProperties->getRootDirectoryPath() . '/' . $appendedPath;
        }
        if (empty($discoverableDirectories->getDirectoryPathFilters())) {
            $fullPaths[] = $filesystemProperties->getSourceDirectoryPath();
            if ($filesystem->exists($filesystemProperties->getFabricationDirectoryPath())) {
                $fullPaths[] = $filesystemProperties->getFabricationDirectoryPath();
            }
        } else {
            foreach ($discoverableDirectories->getDirectoryPathFilters() as $directoryPathFilter) {
                $fullPaths[] = $filesystemProperties->getSourceDirectoryPath() . '/' . $directoryPathFilter;
                $fabricationPathCandidate = $filesystemProperties->getFabricationDirectoryPath() . '/' . $directoryPathFilter;
                if ($filesystem->exists($fabricationPathCandidate)) {
                    $fullPaths[] = $fabricationPathCandidate;
                }
            }
        }
        $fullPaths = array_merge($fullPaths, $discoverableDirectories->getWelcomeBaskets()->getDirectoryPaths());
        return $fullPaths;
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
