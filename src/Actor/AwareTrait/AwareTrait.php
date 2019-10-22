<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\AwareTrait;

use Neighborhoods\Prefab\Actor\AwareTraitInterface;

trait AwareTrait
{
    protected $ActorAwareTrait;

    public function setActorAwareTrait(AwareTraitInterface $AwareTrait): self
    {
        if ($this->hasActorAwareTrait()) {
            throw new \LogicException('ActorAwareTrait is already set.');
        }
        $this->ActorAwareTrait = $AwareTrait;

        return $this;
    }

    protected function getActorAwareTrait(): AwareTraitInterface
    {
        if (!$this->hasActorAwareTrait()) {
            throw new \LogicException('ActorAwareTrait is not set.');
        }

        return $this->ActorAwareTrait;
    }

    protected function hasActorAwareTrait(): bool
    {
        return isset($this->ActorAwareTrait);
    }

    protected function unsetActorAwareTrait(): self
    {
        if (!$this->hasActorAwareTrait()) {
            throw new \LogicException('ActorAwareTrait is not set.');
        }
        unset($this->ActorAwareTrait);

        return $this;
    }
}
