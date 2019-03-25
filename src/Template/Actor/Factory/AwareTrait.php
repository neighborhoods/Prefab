<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Factory;

use Neighborhoods\Bradfab\Template\Actor\FactoryInterface;

trait AwareTrait
{
    protected $ActorFactory;

    public function setActorFactory(FactoryInterface $ActorFactory): self
    {
        if ($this->hasActorFactory()) {
            throw new \LogicException('ActorFactory is already set.');
        }
        $this->ActorFactory = $ActorFactory;

        return $this;
    }

    protected function getActorFactory(): FactoryInterface
    {
        if (!$this->hasActorFactory()) {
            throw new \LogicException('ActorFactory is not set.');
        }

        return $this->ActorFactory;
    }

    protected function hasActorFactory(): bool
    {
        return isset($this->ActorFactory);
    }

    protected function unsetActorFactory(): self
    {
        if (!$this->hasActorFactory()) {
            throw new \LogicException('ActorFactory is not set.');
        }
        unset($this->ActorFactory);

        return $this;
    }
}
