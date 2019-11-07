<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\TokenReplacer\Factory;

use Neighborhoods\Prefab\TokenReplacer\FactoryInterface;

trait AwareTrait
{
    protected $TokenReplacerFactory;

    public function setTokenReplacerFactory(FactoryInterface $TokenReplacerFactory): self
    {
        if ($this->hasTokenReplacerFactory()) {
            throw new \LogicException('TokenReplacerFactory is already set.');
        }
        $this->TokenReplacerFactory = $TokenReplacerFactory;

        return $this;
    }

    protected function getTokenReplacerFactory(): FactoryInterface
    {
        if (!$this->hasTokenReplacerFactory()) {
            throw new \LogicException('TokenReplacerFactory is not set.');
        }

        return $this->TokenReplacerFactory;
    }

    protected function hasTokenReplacerFactory(): bool
    {
        return isset($this->TokenReplacerFactory);
    }

    protected function unsetTokenReplacerFactory(): self
    {
        if (!$this->hasTokenReplacerFactory()) {
            throw new \LogicException('TokenReplacerFactory is not set.');
        }
        unset($this->TokenReplacerFactory);

        return $this;
    }
}
