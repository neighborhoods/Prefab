<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Writer;

use Neighborhoods\Prefab\FabricationSpecification\WriterInterface;

trait AwareTrait
{
    protected $FabricationSpecificationWriter;

    public function setFabricationSpecificationWriter(WriterInterface $Writer): self
    {
        if ($this->hasActor()) {
            throw new \LogicException('Actor is already set.');
        }
        $this->FabricationSpecificationWriter = $Writer;

        return $this;
    }

    protected function getFabricationSpecificationWriter(): WriterInterface
    {
        if (!$this->hasActor()) {
            throw new \LogicException('Actor is not set.');
        }

        return $this->FabricationSpecificationWriter;
    }

    protected function hasActor(): bool
    {
        return isset($this->FabricationSpecificationWriter);
    }

    protected function unsetFabricationSpecificationWriter(): self
    {
        if (!$this->hasActor()) {
            throw new \LogicException('Actor is not set.');
        }
        unset($this->FabricationSpecificationWriter);

        return $this;
    }
}
