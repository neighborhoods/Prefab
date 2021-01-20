<?php


namespace Neighborhoods\Prefab;


use LogicException;
use Neighborhoods\Prefab\Protean\Container\Builder;

class Prefab implements PrefabInterface
{
    protected $applicationRootDirectoryPath;
    protected $project_dir;

    public function generate() : PrefabInterface
    {
        $container = (new Builder())
            ->setApplicationRootDirectoryPath($this->getApplicationRootDirectoryPath())
            ->build();

        $container
            ->get(GeneratorInterface::class)
            ->setProjectRoot($this->getProjectDir())
            ->generate();

        return $this;
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
        if (isset($this->applicationRootDirectoryPath)) {
            throw new LogicException('Application Root Directory Path is already set.');
        }
        $this->applicationRootDirectoryPath = $applicationRootDirectoryPath;
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
