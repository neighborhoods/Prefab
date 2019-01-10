<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap;

    public function setPrefab5OpcacheHTTPBuildableDirectoryMap(HTTPBuildableDirectoryMapInterface $prefab5OpcacheHTTPBuildableDirectoryMap) : self
    {
        if ($this->hasPrefab5OpcacheHTTPBuildableDirectoryMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap = $prefab5OpcacheHTTPBuildableDirectoryMap;

        return $this;
    }

    protected function getPrefab5OpcacheHTTPBuildableDirectoryMap() : HTTPBuildableDirectoryMapInterface
    {
        if (!$this->hasPrefab5OpcacheHTTPBuildableDirectoryMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap;
    }

    protected function hasPrefab5OpcacheHTTPBuildableDirectoryMap() : bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap);
    }

    protected function unsetPrefab5OpcacheHTTPBuildableDirectoryMap() : self
    {
        if (!$this->hasPrefab5OpcacheHTTPBuildableDirectoryMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap);

        return $this;
    }
}
