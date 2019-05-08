<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\Minimal\Factory;

use Neighborhoods\Prefab\SupportingActorGroup\Minimal\FactoryInterface;

trait AwareTrait
{
    protected $MinimalFactory;

    public function setMinimalFactory(FactoryInterface $MinimalFactory): self
    {
        if ($this->hasMinimalFactory()) {
            throw new \LogicException('MinimalFactory is already set.');
        }
        $this->MinimalFactory = $MinimalFactory;

        return $this;
    }

    protected function getMinimalFactory(): FactoryInterface
    {
        if (!$this->hasMinimalFactory()) {
            throw new \LogicException('MinimalFactory is not set.');
        }

        return $this->MinimalFactory;
    }

    protected function hasMinimalFactory(): bool
    {
        return isset($this->MinimalFactory);
    }

    protected function unsetMinimalFactory(): self
    {
        if (!$this->hasMinimalFactory()) {
            throw new \LogicException('MinimalFactory is not set.');
        }
        unset($this->MinimalFactory);

        return $this;
    }
}
