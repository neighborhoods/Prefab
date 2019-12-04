<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Writer;

use Neighborhoods\Prefab\FabricationSpecification\WriterInterface;

trait AwareTrait
{
    protected $Actor;

    public function setActor(WriterInterface $Actor): self
    {
        if ($this->hasActor()) {
            throw new \LogicException('Actor is already set.');
        }
        $this->Actor = $Actor;

        return $this;
    }

    protected function getActor(): WriterInterface
    {
        if (!$this->hasActor()) {
            throw new \LogicException('Actor is not set.');
        }

        return $this->Actor;
    }

    protected function hasActor(): bool
    {
        return isset($this->Actor);
    }

    protected function unsetActor(): self
    {
        if (!$this->hasActor()) {
            throw new \LogicException('Actor is not set.');
        }
        unset($this->Actor);

        return $this;
    }
}
