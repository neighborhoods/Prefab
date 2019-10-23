<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Collection\Factory;

use Neighborhoods\Prefab\FabricationSpecification\Collection\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationCollectionFactory;

    public function setFabricationSpecificationCollectionFactory(FactoryInterface $CollectionFactory): self
    {
        if ($this->hasFabricationSpecificationCollectionFactory()) {
            throw new \LogicException('FabricationSpecificationCollectionFactory is already set.');
        }
        $this->FabricationSpecificationCollectionFactory = $CollectionFactory;

        return $this;
    }

    protected function getFabricationSpecificationCollectionFactory(): FactoryInterface
    {
        if (!$this->hasFabricationSpecificationCollectionFactory()) {
            throw new \LogicException('FabricationSpecificationCollectionFactory is not set.');
        }

        return $this->FabricationSpecificationCollectionFactory;
    }

    protected function hasFabricationSpecificationCollectionFactory(): bool
    {
        return isset($this->FabricationSpecificationCollectionFactory);
    }

    protected function unsetFabricationSpecificationCollectionFactory(): self
    {
        if (!$this->hasFabricationSpecificationCollectionFactory()) {
            throw new \LogicException('FabricationSpecificationCollectionFactory is not set.');
        }
        unset($this->FabricationSpecificationCollectionFactory);

        return $this;
    }
}
