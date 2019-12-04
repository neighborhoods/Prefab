<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Writer\Factory;

use Neighborhoods\Prefab\FabricationSpecification\Writer\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationWriterFactory;

    public function setFabricationSpecificationWriterFactory(FactoryInterface $WriterFactory): self
    {
        if ($this->hasActorFactory()) {
            throw new \LogicException('ActorFactory is already set.');
        }
        $this->FabricationSpecificationWriterFactory = $WriterFactory;

        return $this;
    }

    protected function getFabricationSpecificationWriterFactory(): FactoryInterface
    {
        if (!$this->hasActorFactory()) {
            throw new \LogicException('ActorFactory is not set.');
        }

        return $this->FabricationSpecificationWriterFactory;
    }

    protected function hasActorFactory(): bool
    {
        return isset($this->FabricationSpecificationWriterFactory);
    }

    protected function unsetFabricationSpecificationWriterFactory(): self
    {
        if (!$this->hasActorFactory()) {
            throw new \LogicException('ActorFactory is not set.');
        }
        unset($this->FabricationSpecificationWriterFactory);

        return $this;
    }
}
