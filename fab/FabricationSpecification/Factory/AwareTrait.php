<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Factory;

use Neighborhoods\Prefab\FabricationSpecification\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationFactory;

    public function setFabricationSpecificationFactory(FactoryInterface $FabricationSpecificationFactory): self
    {
        if ($this->hasFabricationSpecificationFactory()) {
            throw new \LogicException('ActorFactory is already set.');
        }
        $this->FabricationSpecificationFactory = $FabricationSpecificationFactory;

        return $this;
    }

    protected function getFabricationSpecificationFactory(): FactoryInterface
    {
        if (!$this->hasFabricationSpecificationFactory()) {
            throw new \LogicException('ActorFactory is not set.');
        }

        return $this->FabricationSpecificationFactory;
    }

    protected function hasFabricationSpecificationFactory(): bool
    {
        return isset($this->FabricationSpecificationFactory);
    }

    protected function unsetFabricationSpecificationFactory(): self
    {
        if (!$this->hasFabricationSpecificationFactory()) {
            throw new \LogicException('ActorFactory is not set.');
        }
        unset($this->FabricationSpecificationFactory);

        return $this;
    }
}
