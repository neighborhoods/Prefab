<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Map\Factory;

use Neighborhoods\Bradfab\Template\Actor\Map\FactoryInterface;

trait AwareTrait
{
    protected $ActorMapFactory;

    public function setActorMapFactory(FactoryInterface $ActorMapFactory): self
    {
        if ($this->hasActorMapFactory()) {
            throw new \LogicException('ActorMapFactory is already set.');
        }
        $this->ActorMapFactory = $ActorMapFactory;

        return $this;
    }

    protected function getActorMapFactory(): FactoryInterface
    {
        if (!$this->hasActorMapFactory()) {
            throw new \LogicException('ActorMapFactory is not set.');
        }

        return $this->ActorMapFactory;
    }

    protected function hasActorMapFactory(): bool
    {
        return isset($this->ActorMapFactory);
    }

    protected function unsetActorMapFactory(): self
    {
        if (!$this->hasActorMapFactory()) {
            throw new \LogicException('ActorMapFactory is not set.');
        }
        unset($this->ActorMapFactory);

        return $this;
    }
}
