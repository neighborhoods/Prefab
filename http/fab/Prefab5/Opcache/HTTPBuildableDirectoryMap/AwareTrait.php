<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap;

    public function setPrefab5OpcacheHTTPBuildableDirectoryMap(HTTPBuildableDirectoryMapInterface $prefab5OpcacheHTTPBuildableDirectoryMap) : self
    {
        if ($this->hasPrefab5OpcacheHTTPBuildableDirectoryMap()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap = $prefab5OpcacheHTTPBuildableDirectoryMap;

        return $this;
    }

    protected function getPrefab5OpcacheHTTPBuildableDirectoryMap() : HTTPBuildableDirectoryMapInterface
    {
        if (!$this->hasPrefab5OpcacheHTTPBuildableDirectoryMap()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap;
    }

    protected function hasPrefab5OpcacheHTTPBuildableDirectoryMap() : bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap);
    }

    protected function unsetPrefab5OpcacheHTTPBuildableDirectoryMap() : self
    {
        if (!$this->hasPrefab5OpcacheHTTPBuildableDirectoryMap()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5OpcacheHTTPBuildableDirectoryMap);

        return $this;
    }
}
