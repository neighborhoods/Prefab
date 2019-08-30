<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder;

    public function setPrefab5HTTPBuildableDirectoryMapContainerBuilder(ContainerBuilderInterface $prefab5HTTPBuildableDirectoryMapContainerBuilder) : self
    {
        if ($this->hasPrefab5HTTPBuildableDirectoryMapContainerBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder = $prefab5HTTPBuildableDirectoryMapContainerBuilder;

        return $this;
    }

    protected function getPrefab5HTTPBuildableDirectoryMapContainerBuilder() : ContainerBuilderInterface
    {
        if (!$this->hasPrefab5HTTPBuildableDirectoryMapContainerBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder;
    }

    protected function hasPrefab5HTTPBuildableDirectoryMapContainerBuilder() : bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder);
    }

    protected function unsetPrefab5HTTPBuildableDirectoryMapContainerBuilder() : self
    {
        if (!$this->hasPrefab5HTTPBuildableDirectoryMapContainerBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder);

        return $this;
    }
}
