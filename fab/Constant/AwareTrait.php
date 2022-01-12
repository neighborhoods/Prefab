<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Constant;

use Neighborhoods\Prefab\ConstantInterface;

trait AwareTrait
{
    protected $Constant;

    public function setConstant(ConstantInterface $Constant): self
    {
        if ($this->hasConstant()) {
            throw new \LogicException('Constant is already set.');
        }
        $this->Constant = $Constant;

        return $this;
    }

    protected function getConstant(): ConstantInterface
    {
        if (!$this->hasConstant()) {
            throw new \LogicException('Constant is not set.');
        }

        return $this->Constant;
    }

    protected function hasConstant(): bool
    {
        return isset($this->Constant);
    }

    protected function unsetConstant(): self
    {
        if (!$this->hasConstant()) {
            throw new \LogicException('Constant is not set.');
        }
        unset($this->Constant);

        return $this;
    }
}
