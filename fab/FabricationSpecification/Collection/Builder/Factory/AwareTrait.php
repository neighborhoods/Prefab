<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Collection\Builder\Factory;

use Neighborhoods\Prefab\FabricationSpecification\Collection\Builder\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationCollectionBuilderFactory;

    public function setFabricationSpecificationCollectionBuilderFactory(FactoryInterface $CollectionBuilderFactory): self
    {
        if ($this->hasFabricationSpecificationCollectionBuilderFactory()) {
            throw new \LogicException('FabricationSpecificationCollectionBuilderFactory is already set.');
        }
        $this->FabricationSpecificationCollectionBuilderFactory = $CollectionBuilderFactory;

        return $this;
    }

    protected function getFabricationSpecificationCollectionBuilderFactory(): FactoryInterface
    {
        if (!$this->hasFabricationSpecificationCollectionBuilderFactory()) {
            throw new \LogicException('FabricationSpecificationCollectionBuilderFactory is not set.');
        }

        return $this->FabricationSpecificationCollectionBuilderFactory;
    }

    protected function hasFabricationSpecificationCollectionBuilderFactory(): bool
    {
        return isset($this->FabricationSpecificationCollectionBuilderFactory);
    }

    protected function unsetFabricationSpecificationCollectionBuilderFactory(): self
    {
        if (!$this->hasFabricationSpecificationCollectionBuilderFactory()) {
            throw new \LogicException('FabricationSpecificationCollectionBuilderFactory is not set.');
        }
        unset($this->FabricationSpecificationCollectionBuilderFactory);

        return $this;
    }
}
