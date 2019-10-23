<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Writer\Factory;

use Neighborhoods\Prefab\FabricationSpecification\Writer\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationWriterFactory;

    public function setFabricationSpecificationWriterFactory(FactoryInterface $WriterFactory): self
    {
        if ($this->hasFabricationSpecificationWriterFactory()) {
            throw new \LogicException('FabricationSpecificationWriterFactory is already set.');
        }
        $this->FabricationSpecificationWriterFactory = $WriterFactory;

        return $this;
    }

    protected function getFabricationSpecificationWriterFactory(): FactoryInterface
    {
        if (!$this->hasFabricationSpecificationWriterFactory()) {
            throw new \LogicException('FabricationSpecificationWriterFactory is not set.');
        }

        return $this->FabricationSpecificationWriterFactory;
    }

    protected function hasFabricationSpecificationWriterFactory(): bool
    {
        return isset($this->FabricationSpecificationWriterFactory);
    }

    protected function unsetFabricationSpecificationWriterFactory(): self
    {
        if (!$this->hasFabricationSpecificationWriterFactory()) {
            throw new \LogicException('FabricationSpecificationWriterFactory is not set.');
        }
        unset($this->FabricationSpecificationWriterFactory);

        return $this;
    }
}
