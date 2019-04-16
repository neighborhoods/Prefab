<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HttpBuildableDirectoryMap\ContainerBuilder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HttpBuildableDirectoryMap\ContainerBuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilder;

    public function setPrefab5HttpBuildableDirectoryMapContainerBuilder(ContainerBuilderInterface $prefab5HttpBuildableDirectoryMapContainerBuilder) : self
    {
        if ($this->hasPrefab5HttpBuildableDirectoryMapContainerBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilder is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilder = $prefab5HttpBuildableDirectoryMapContainerBuilder;

        return $this;
    }

    protected function getPrefab5HttpBuildableDirectoryMapContainerBuilder() : ContainerBuilderInterface
    {
        if (!$this->hasPrefab5HttpBuildableDirectoryMapContainerBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilder is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilder;
    }

    protected function hasPrefab5HttpBuildableDirectoryMapContainerBuilder() : bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilder);
    }

    protected function unsetPrefab5HttpBuildableDirectoryMapContainerBuilder() : self
    {
        if (!$this->hasPrefab5HttpBuildableDirectoryMapContainerBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilder is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5HttpBuildableDirectoryMapContainerBuilder);

        return $this;
    }
}
