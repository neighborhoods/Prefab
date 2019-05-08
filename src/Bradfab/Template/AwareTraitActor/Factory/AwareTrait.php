<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\AwareTraitActor\Factory;

use Neighborhoods\Prefab\Bradfab\Template\AwareTraitActor\FactoryInterface;

trait AwareTrait
{
    protected $AwareTraitActorFactory;

    public function setAwareTraitActorFactory(FactoryInterface $AwareTraitActorFactory): self
    {
        if ($this->hasAwareTraitActorFactory()) {
            throw new \LogicException('AwareTraitActorFactory is already set.');
        }
        $this->AwareTraitActorFactory = $AwareTraitActorFactory;

        return $this;
    }

    protected function getAwareTraitActorFactory(): FactoryInterface
    {
        if (!$this->hasAwareTraitActorFactory()) {
            throw new \LogicException('AwareTraitActorFactory is not set.');
        }

        return $this->AwareTraitActorFactory;
    }

    protected function hasAwareTraitActorFactory(): bool
    {
        return isset($this->AwareTraitActorFactory);
    }

    protected function unsetAwareTraitActorFactory(): self
    {
        if (!$this->hasAwareTraitActorFactory()) {
            throw new \LogicException('AwareTraitActorFactory is not set.');
        }
        unset($this->AwareTraitActorFactory);

        return $this;
    }
}
