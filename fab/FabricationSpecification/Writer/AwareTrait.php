<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Writer;

use Neighborhoods\Prefab\FabricationSpecification\WriterInterface;

trait AwareTrait
{
    protected $FabricationSpecificationWriter;

    public function setFabricationSpecificationWriter(WriterInterface $Writer): self
    {
        if ($this->hasFabricationSpecificationWriter()) {
            throw new \LogicException('FabricationSpecificationWriter is already set.');
        }
        $this->FabricationSpecificationWriter = $Writer;

        return $this;
    }

    protected function getFabricationSpecificationWriter(): WriterInterface
    {
        if (!$this->hasFabricationSpecificationWriter()) {
            throw new \LogicException('FabricationSpecificationWriter is not set.');
        }

        return $this->FabricationSpecificationWriter;
    }

    protected function hasFabricationSpecificationWriter(): bool
    {
        return isset($this->FabricationSpecificationWriter);
    }

    protected function unsetFabricationSpecificationWriter(): self
    {
        if (!$this->hasFabricationSpecificationWriter()) {
            throw new \LogicException('FabricationSpecificationWriter is not set.');
        }
        unset($this->FabricationSpecificationWriter);

        return $this;
    }
}
