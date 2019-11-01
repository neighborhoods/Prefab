<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Collection\Builder;

use Neighborhoods\Prefab\FabricationSpecification\Collection\BuilderInterface;

trait AwareTrait
{
    protected $FabricationSpecificationCollectionBuilder;

    public function setFabricationSpecificationCollectionBuilder(BuilderInterface $CollectionBuilder): self
    {
        if ($this->hasFabricationSpecificationCollectionBuilder()) {
            throw new \LogicException('FabricationSpecificationCollectionBuilder is already set.');
        }
        $this->FabricationSpecificationCollectionBuilder = $CollectionBuilder;

        return $this;
    }

    protected function getFabricationSpecificationCollectionBuilder(): BuilderInterface
    {
        if (!$this->hasFabricationSpecificationCollectionBuilder()) {
            throw new \LogicException('FabricationSpecificationCollectionBuilder is not set.');
        }

        return $this->FabricationSpecificationCollectionBuilder;
    }

    protected function hasFabricationSpecificationCollectionBuilder(): bool
    {
        return isset($this->FabricationSpecificationCollectionBuilder);
    }

    protected function unsetFabricationSpecificationCollectionBuilder(): self
    {
        if (!$this->hasFabricationSpecificationCollectionBuilder()) {
            throw new \LogicException('FabricationSpecificationCollectionBuilder is not set.');
        }
        unset($this->FabricationSpecificationCollectionBuilder);

        return $this;
    }
}
