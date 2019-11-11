<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Constant\Map\Factory;

use Neighborhoods\Prefab\Constant\Map\FactoryInterface;

trait AwareTrait
{
    protected $ConstantMapFactory;

    public function setConstantMapFactory(FactoryInterface $ConstantMapFactory): self
    {
        if ($this->hasConstantMapFactory()) {
            throw new \LogicException('ConstantMapFactory is already set.');
        }
        $this->ConstantMapFactory = $ConstantMapFactory;

        return $this;
    }

    protected function getConstantMapFactory(): FactoryInterface
    {
        if (!$this->hasConstantMapFactory()) {
            throw new \LogicException('ConstantMapFactory is not set.');
        }

        return $this->ConstantMapFactory;
    }

    protected function hasConstantMapFactory(): bool
    {
        return isset($this->ConstantMapFactory);
    }

    protected function unsetConstantMapFactory(): self
    {
        if (!$this->hasConstantMapFactory()) {
            throw new \LogicException('ConstantMapFactory is not set.');
        }
        unset($this->ConstantMapFactory);

        return $this;
    }
}
