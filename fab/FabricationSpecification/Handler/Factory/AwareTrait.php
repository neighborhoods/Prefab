<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Handler\Factory;

use Neighborhoods\Prefab\FabricationSpecification\Handler\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationHandlerFactory;

    public function setFabricationSpecificationHandlerFactory(FactoryInterface $HandlerFactory): self
    {
        if ($this->hasFabricationSpecificationHandlerFactory()) {
            throw new \LogicException('ActorFactory is already set.');
        }
        $this->FabricationSpecificationHandlerFactory = $HandlerFactory;

        return $this;
    }

    protected function getFabricationSpecificationHandlerFactory(): FactoryInterface
    {
        if (!$this->hasFabricationSpecificationHandlerFactory()) {
            throw new \LogicException('ActorFactory is not set.');
        }

        return $this->FabricationSpecificationHandlerFactory;
    }

    protected function hasFabricationSpecificationHandlerFactory(): bool
    {
        return isset($this->FabricationSpecificationHandlerFactory);
    }

    protected function unsetFabricationSpecificationHandlerFactory(): self
    {
        if (!$this->hasFabricationSpecificationHandlerFactory()) {
            throw new \LogicException('ActorFactory is not set.');
        }
        unset($this->FabricationSpecificationHandlerFactory);

        return $this;
    }
}
