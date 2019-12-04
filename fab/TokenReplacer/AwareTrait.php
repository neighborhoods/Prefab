<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\TokenReplacer;

use Neighborhoods\Prefab\TokenReplacerInterface;

trait AwareTrait
{
    protected $TokenReplacer;

    public function setTokenReplacer(TokenReplacerInterface $TokenReplacer): self
    {
        if ($this->hasActor()) {
            throw new \LogicException('Actor is already set.');
        }
        $this->TokenReplacer = $TokenReplacer;

        return $this;
    }

    protected function getTokenReplacer(): TokenReplacerInterface
    {
        if (!$this->hasActor()) {
            throw new \LogicException('Actor is not set.');
        }

        return $this->TokenReplacer;
    }

    protected function hasActor(): bool
    {
        return isset($this->TokenReplacer);
    }

    protected function unsetTokenReplacer(): self
    {
        if (!$this->hasActor()) {
            throw new \LogicException('Actor is not set.');
        }
        unset($this->TokenReplacer);

        return $this;
    }
}
