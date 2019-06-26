<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\FactoryActor\Factory;

use Neighborhoods\Prefab\Bradfab\Template\FactoryActor\FactoryInterface;

trait AwareTrait
{
    protected $FactoryActorFactory;

    public function setFactoryActorFactory(FactoryInterface $FactoryActorFactory): self
    {
        if ($this->hasFactoryActorFactory()) {
            throw new \LogicException('FactoryActorFactory is already set.');
        }
        $this->FactoryActorFactory = $FactoryActorFactory;

        return $this;
    }

    protected function getFactoryActorFactory(): FactoryInterface
    {
        if (!$this->hasFactoryActorFactory()) {
            throw new \LogicException('FactoryActorFactory is not set.');
        }

        return $this->FactoryActorFactory;
    }

    protected function hasFactoryActorFactory(): bool
    {
        return isset($this->FactoryActorFactory);
    }

    protected function unsetFactoryActorFactory(): self
    {
        if (!$this->hasFactoryActorFactory()) {
            throw new \LogicException('FactoryActorFactory is not set.');
        }
        unset($this->FactoryActorFactory);

        return $this;
    }
}
