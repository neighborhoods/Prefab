<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Constant\Factory;

use Neighborhoods\Prefab\Constant\FactoryInterface;

trait AwareTrait
{
    protected $ConstantFactory;

    public function setConstantFactory(FactoryInterface $ConstantFactory): self
    {
        if ($this->hasConstantFactory()) {
            throw new \LogicException('ConstantFactory is already set.');
        }
        $this->ConstantFactory = $ConstantFactory;

        return $this;
    }

    protected function getConstantFactory(): FactoryInterface
    {
        if (!$this->hasConstantFactory()) {
            throw new \LogicException('ConstantFactory is not set.');
        }

        return $this->ConstantFactory;
    }

    protected function hasConstantFactory(): bool
    {
        return isset($this->ConstantFactory);
    }

    protected function unsetConstantFactory(): self
    {
        if (!$this->hasConstantFactory()) {
            throw new \LogicException('ConstantFactory is not set.');
        }
        unset($this->ConstantFactory);

        return $this;
    }
}
