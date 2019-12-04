<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Minimal\Factory;

use Neighborhoods\Prefab\FabricationSpecification\Minimal\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationMinimalFactory;

    public function setFabricationSpecificationMinimalFactory(FactoryInterface $MinimalFactory): self
    {
        if ($this->hasActorFactory()) {
            throw new \LogicException('ActorFactory is already set.');
        }
        $this->FabricationSpecificationMinimalFactory = $MinimalFactory;

        return $this;
    }

    protected function getFabricationSpecificationMinimalFactory(): FactoryInterface
    {
        if (!$this->hasActorFactory()) {
            throw new \LogicException('ActorFactory is not set.');
        }

        return $this->FabricationSpecificationMinimalFactory;
    }

    protected function hasActorFactory(): bool
    {
        return isset($this->FabricationSpecificationMinimalFactory);
    }

    protected function unsetFabricationSpecificationMinimalFactory(): self
    {
        if (!$this->hasActorFactory()) {
            throw new \LogicException('ActorFactory is not set.');
        }
        unset($this->FabricationSpecificationMinimalFactory);

        return $this;
    }
}
