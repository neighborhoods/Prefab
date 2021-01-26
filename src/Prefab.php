<?php


namespace Neighborhoods\Prefab;


use LogicException;
use Psr\Container\ContainerInterface;

class Prefab implements PrefabInterface
{
    protected $applicationRootDirectoryPath;
    protected $container;
    protected $project_dir;

    public function generate() : PrefabInterface
    {
        $container = $this->getContainer();

        $container
            ->get(GeneratorInterface::class)
            ->setProjectRoot($this->getProjectDir())
            ->generate();

        return $this;
    }

    protected function getContainer(): ContainerInterface
    {
        if ($this->container === null) {

            $containerBuilder = (new \Neighborhoods\DependencyInjectionContainerBuilderComponent\TinyContainerBuilder())
                ->setContainerBuilder(new \Symfony\Component\DependencyInjection\ContainerBuilder())
                ->setRootPath($this->getApplicationRootDirectoryPath())
                ->addSourcePath('src')
                ->addSourcePath('fab')
                ->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\AnalyzeServiceReferencesPass())
                ->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\InlineServiceDefinitionsPass());
            $this->container = $containerBuilder->build();
        }

        return $this->container;
    }

    protected function getProjectDir()
    {
        if ($this->project_dir === null) {
            throw new LogicException('Prefab project_dir has not been set.');
        }
        return $this->project_dir;
    }

    public function setProjectDir($project_dir) : PrefabInterface
    {
        if ($this->project_dir !== null) {
            throw new LogicException('Prefab project_dir is already set.');
        }
        $this->project_dir = $project_dir;
        return $this;
    }

    public function setApplicationRootDirectoryPath(string $applicationRootDirectoryPath): PrefabInterface
    {
        if ($this->applicationRootDirectoryPath === null) {
            $applicationRootDirectoryPath = realpath(rtrim($applicationRootDirectoryPath, "/"));
            if (is_dir($applicationRootDirectoryPath)) {
                $this->applicationRootDirectoryPath = $applicationRootDirectoryPath;
            } else {
                $message = sprintf(
                    'Application root directory path[%s] is not a directory.',
                    $applicationRootDirectoryPath
                );
                throw new \UnexpectedValueException($message);
            }
        } else {
            throw new \LogicException('Application root directory path is already set.');
        }

        return $this;
    }

    private function getApplicationRootDirectoryPath(): string
    {
        if (!isset($this->applicationRootDirectoryPath)) {
            throw new LogicException('Application Root Directory Path has not been set.');
        }
        return $this->applicationRootDirectoryPath;
    }
}
