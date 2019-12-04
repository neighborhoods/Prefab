<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Constant\Map\Factory;

use Neighborhoods\Prefab\Constant\Map\FactoryInterface;

trait AwareTrait
{
    protected $ConstantMapFactory;

    public function setConstantMapFactory(FactoryInterface $ConstantMapFactory): self
    {
        if ($this->hasActorMapFactory()) {
            throw new \LogicException('ActorMapFactory is already set.');
        }
        $this->ConstantMapFactory = $ConstantMapFactory;

        return $this;
    }

    protected function getConstantMapFactory(): FactoryInterface
    {
        if (!$this->hasActorMapFactory()) {
            throw new \LogicException('ActorMapFactory is not set.');
        }

        return $this->ConstantMapFactory;
    }

    protected function hasActorMapFactory(): bool
    {
        return isset($this->ConstantMapFactory);
    }

    protected function unsetConstantMapFactory(): self
    {
        if (!$this->hasActorMapFactory()) {
            throw new \LogicException('ActorMapFactory is not set.');
        }
        unset($this->ConstantMapFactory);

        return $this;
    }
}
