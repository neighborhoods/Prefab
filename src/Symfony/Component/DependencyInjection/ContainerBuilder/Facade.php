<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Symfony\Component\DependencyInjection\ContainerBuilder;

use Neighborhoods\Prefab\Symfony\Component\Finder\Map;
use Neighborhoods\Prefab\Symfony\Component\Finder\MapInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Compiler\AnalyzeServiceReferencesPass;
use Symfony\Component\DependencyInjection\Compiler\InlineServiceDefinitionsPass;
use Symfony\Component\Finder\Finder;

class Facade implements FacadeInterface
{
    protected $containerBuilder;
    protected $yamlServicesFilePaths = [];
    protected $finderMap;
    protected $containerIsBuilt = false;
    protected $isYamlAssembled = false;

    public function addFinder(Finder $finder): Facade
    {
        $this->getFinderMap()->append($finder);

        return $this;
    }

    protected function getFinderMap(): MapInterface
    {
        if ($this->finderMap === null) {
            $this->finderMap = new Map();
        }

        return $this->finderMap;
    }

    protected function getYamlServicesFilePaths(): array
    {
        if (empty($this->yamlServicesFilePaths)) {
            foreach ($this->getFinderMap() as $finder) {
                foreach ($finder as $directoryPath => $file) {
                    $this->yamlServicesFilePaths[] = $file->getPathname();
                }
            }
        }

        return $this->yamlServicesFilePaths;
    }

    public function setContainerBuilder(ContainerBuilder $containerBuilder): FacadeInterface
    {
        if ($this->containerBuilder === null) {
            $this->containerBuilder = $containerBuilder;
        } else {
            throw new \LogicException('Container builder is already set.');
        }

        return $this;
    }

    public function getContainerBuilder(): ContainerBuilder
    {
        if ($this->containerBuilder === null) {
            throw new \LogicException('Container builder is not set.');
        }

        return $this->containerBuilder;
    }

    public function assembleYaml(): FacadeInterface
    {
        if ($this->isYamlAssembled === false) {
            $containerBuilder = $this->getContainerBuilder();
            $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
            foreach ($this->getYamlServicesFilePaths() as $servicesYmlFilePath) {
                $loader->import($servicesYmlFilePath);
            }
        } else {
            throw new \LogicException('Yaml is already assembled.');
        }

        return $this;
    }

    public function build(): FacadeInterface
    {
        if ($this->containerIsBuilt === false) {
            $containerBuilder = $this->getContainerBuilder();
            $containerBuilder->addCompilerPass(new AnalyzeServiceReferencesPass());
            $containerBuilder->addCompilerPass(new InlineServiceDefinitionsPass());
            $containerBuilder->compile(true);
            $this->containerIsBuilt = true;
        } else {
            throw new \LogicException('Container is already built.');
        }

        return $this;
    }
}
