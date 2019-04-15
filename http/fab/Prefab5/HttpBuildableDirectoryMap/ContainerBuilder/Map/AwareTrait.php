<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HttpBuildableDirectoryMap\ContainerBuilder\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HttpBuildableDirectoryMap\ContainerBuilder\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilderMap;

    public function setPrefab5HttpBuildableDirectoryMapContainerBuilderMap(MapInterface $prefab5HttpBuildableDirectoryMapContainerBuilderMap) : self
    {
        if ($this->hasPrefab5HttpBuildableDirectoryMapContainerBuilderMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilderMap is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilderMap = $prefab5HttpBuildableDirectoryMapContainerBuilderMap;

        return $this;
    }

    protected function getPrefab5HttpBuildableDirectoryMapContainerBuilderMap() : MapInterface
    {
        if (!$this->hasPrefab5HttpBuildableDirectoryMapContainerBuilderMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilderMap is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilderMap;
    }

    protected function hasPrefab5HttpBuildableDirectoryMapContainerBuilderMap() : bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilderMap);
    }

    protected function unsetPrefab5HttpBuildableDirectoryMapContainerBuilderMap() : self
    {
        if (!$this->hasPrefab5HttpBuildableDirectoryMapContainerBuilderMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilderMap is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilderMap);

        return $this;
    }
}
