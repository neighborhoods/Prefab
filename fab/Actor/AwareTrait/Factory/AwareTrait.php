<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\AwareTrait\Factory;

use Neighborhoods\Prefab\Actor\AwareTrait\FactoryInterface;

trait AwareTrait
{
    protected $ActorAwareTraitFactory;

    public function setActorAwareTraitFactory(FactoryInterface $AwareTraitFactory): self
    {
        if ($this->hasActorAwareTraitFactory()) {
            throw new \LogicException('ActorAwareTraitFactory is already set.');
        }
        $this->ActorAwareTraitFactory = $AwareTraitFactory;

        return $this;
    }

    protected function getActorAwareTraitFactory(): FactoryInterface
    {
        if (!$this->hasActorAwareTraitFactory()) {
            throw new \LogicException('ActorAwareTraitFactory is not set.');
        }

        return $this->ActorAwareTraitFactory;
    }

    protected function hasActorAwareTraitFactory(): bool
    {
        return isset($this->ActorAwareTraitFactory);
    }

    protected function unsetActorAwareTraitFactory(): self
    {
        if (!$this->hasActorAwareTraitFactory()) {
            throw new \LogicException('ActorAwareTraitFactory is not set.');
        }
        unset($this->ActorAwareTraitFactory);

        return $this;
    }
}
