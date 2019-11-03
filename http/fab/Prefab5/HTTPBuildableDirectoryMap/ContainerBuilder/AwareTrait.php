<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder;

    public function setPrefab5HTTPBuildableDirectoryMapContainerBuilder(ContainerBuilderInterface $prefab5HTTPBuildableDirectoryMapContainerBuilder) : self
    {
        if ($this->hasPrefab5HTTPBuildableDirectoryMapContainerBuilder()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder = $prefab5HTTPBuildableDirectoryMapContainerBuilder;

        return $this;
    }

    protected function getPrefab5HTTPBuildableDirectoryMapContainerBuilder() : ContainerBuilderInterface
    {
        if (!$this->hasPrefab5HTTPBuildableDirectoryMapContainerBuilder()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder;
    }

    protected function hasPrefab5HTTPBuildableDirectoryMapContainerBuilder() : bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder);
    }

    protected function unsetPrefab5HTTPBuildableDirectoryMapContainerBuilder() : self
    {
        if (!$this->hasPrefab5HTTPBuildableDirectoryMapContainerBuilder()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5HTTPBuildableDirectoryMapContainerBuilder);

        return $this;
    }
}
