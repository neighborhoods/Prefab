<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Handler\Builder;

use Neighborhoods\Prefab\FabricationSpecification\Handler\BuilderInterface;

trait AwareTrait
{
    protected $FabricationSpecificationHandlerBuilder;

    public function setFabricationSpecificationHandlerBuilder(BuilderInterface $HandlerBuilder): self
    {
        if ($this->hasFabricationSpecificationHandlerBuilder()) {
            throw new \LogicException('FabricationSpecificationHandlerBuilder is already set.');
        }
        $this->FabricationSpecificationHandlerBuilder = $HandlerBuilder;

        return $this;
    }

    protected function getFabricationSpecificationHandlerBuilder(): BuilderInterface
    {
        if (!$this->hasFabricationSpecificationHandlerBuilder()) {
            throw new \LogicException('FabricationSpecificationHandlerBuilder is not set.');
        }

        return $this->FabricationSpecificationHandlerBuilder;
    }

    protected function hasFabricationSpecificationHandlerBuilder(): bool
    {
        return isset($this->FabricationSpecificationHandlerBuilder);
    }

    protected function unsetFabricationSpecificationHandlerBuilder(): self
    {
        if (!$this->hasFabricationSpecificationHandlerBuilder()) {
            throw new \LogicException('FabricationSpecificationHandlerBuilder is not set.');
        }
        unset($this->FabricationSpecificationHandlerBuilder);

        return $this;
    }
}
