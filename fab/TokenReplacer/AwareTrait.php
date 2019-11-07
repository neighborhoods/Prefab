<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\TokenReplacer;

use Neighborhoods\Prefab\TokenReplacerInterface;

trait AwareTrait
{
    protected $TokenReplacer;

    public function setTokenReplacer(TokenReplacerInterface $TokenReplacer): self
    {
        if ($this->hasTokenReplacer()) {
            throw new \LogicException('TokenReplacer is already set.');
        }
        $this->TokenReplacer = $TokenReplacer;

        return $this;
    }

    protected function getTokenReplacer(): TokenReplacerInterface
    {
        if (!$this->hasTokenReplacer()) {
            throw new \LogicException('TokenReplacer is not set.');
        }

        return $this->TokenReplacer;
    }

    protected function hasTokenReplacer(): bool
    {
        return isset($this->TokenReplacer);
    }

    protected function unsetTokenReplacer(): self
    {
        if (!$this->hasTokenReplacer()) {
            throw new \LogicException('TokenReplacer is not set.');
        }
        unset($this->TokenReplacer);

        return $this;
    }
}
