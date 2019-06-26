<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\AwareTraitActor;

use Neighborhoods\Prefab\Bradfab\Template\AwareTraitActorInterface;

trait AwareTrait
{
    protected $AwareTraitActor;

    public function setAwareTraitActor(AwareTraitActorInterface $AwareTraitActor): self
    {
        if ($this->hasAwareTraitActor()) {
            throw new \LogicException('AwareTraitActor is already set.');
        }
        $this->AwareTraitActor = $AwareTraitActor;

        return $this;
    }

    protected function getAwareTraitActor(): AwareTraitActorInterface
    {
        if (!$this->hasAwareTraitActor()) {
            throw new \LogicException('AwareTraitActor is not set.');
        }

        return $this->AwareTraitActor;
    }

    protected function hasAwareTraitActor(): bool
    {
        return isset($this->AwareTraitActor);
    }

    protected function unsetAwareTraitActor(): self
    {
        if (!$this->hasAwareTraitActor()) {
            throw new \LogicException('AwareTraitActor is not set.');
        }
        unset($this->AwareTraitActor);

        return $this;
    }
}
