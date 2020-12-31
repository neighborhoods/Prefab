<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Handler\Builder\Factory;

use Neighborhoods\Prefab\FabricationSpecification\Handler\Builder\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationHandlerBuilderFactory;

    public function setFabricationSpecificationHandlerBuilderFactory(FactoryInterface $HandlerBuilderFactory): self
    {
        if ($this->hasFabricationSpecificationHandlerBuilderFactory()) {
            throw new \LogicException('ActorBuilderFactory is already set.');
        }
        $this->FabricationSpecificationHandlerBuilderFactory = $HandlerBuilderFactory;

        return $this;
    }

    protected function getFabricationSpecificationHandlerBuilderFactory(): FactoryInterface
    {
        if (!$this->hasFabricationSpecificationHandlerBuilderFactory()) {
            throw new \LogicException('ActorBuilderFactory is not set.');
        }

        return $this->FabricationSpecificationHandlerBuilderFactory;
    }

    protected function hasFabricationSpecificationHandlerBuilderFactory(): bool
    {
        return isset($this->FabricationSpecificationHandlerBuilderFactory);
    }

    protected function unsetFabricationSpecificationHandlerBuilderFactory(): self
    {
        if (!$this->hasFabricationSpecificationHandlerBuilderFactory()) {
            throw new \LogicException('ActorBuilderFactory is not set.');
        }
        unset($this->FabricationSpecificationHandlerBuilderFactory);

        return $this;
    }
}
