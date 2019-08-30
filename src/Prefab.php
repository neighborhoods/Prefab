<?php


namespace Neighborhoods\Prefab;


use Neighborhoods\Prefab\Protean\Container\Builder;

class Prefab implements PrefabInterface
{

    use Builder\AwareTrait;

    protected $project_dir;

    public function generate() : PrefabInterface
    {
        $this
            ->getProteanContainerBuilder()
            ->build()
            ->get(GeneratorInterface::class)
            ->setProjectRoot($this->getProjectDir())
            ->generate();

        return $this;
    }

    protected function getProjectDir()
    {
        if ($this->project_dir === null) {
            throw new \LogicException('Prefab project_dir has not been set.');
        }
        return $this->project_dir;
    }

    public function setProjectDir($project_dir) : PrefabInterface
    {
        if ($this->project_dir !== null) {
            throw new \LogicException('Prefab project_dir is already set.');
        }
        $this->project_dir = $project_dir;
        return $this;
    }
}
