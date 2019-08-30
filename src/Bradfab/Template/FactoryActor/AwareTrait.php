<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\FactoryActor;

use Neighborhoods\Prefab\Bradfab\Template\FactoryActorInterface;

trait AwareTrait
{
    protected $FactoryActor;

    public function setFactoryActor(FactoryActorInterface $FactoryActor): self
    {
        if ($this->hasFactoryActor()) {
            throw new \LogicException('FactoryActor is already set.');
        }
        $this->FactoryActor = $FactoryActor;

        return $this;
    }

    protected function getFactoryActor(): FactoryActorInterface
    {
        if (!$this->hasFactoryActor()) {
            throw new \LogicException('FactoryActor is not set.');
        }

        return $this->FactoryActor;
    }

    protected function hasFactoryActor(): bool
    {
        return isset($this->FactoryActor);
    }

    protected function unsetFactoryActor(): self
    {
        if (!$this->hasFactoryActor()) {
            throw new \LogicException('FactoryActor is not set.');
        }
        unset($this->FactoryActor);

        return $this;
    }
}
