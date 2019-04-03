<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Map\Builder\Factory;

use Neighborhoods\Bradfab\Template\Actor\Map\Builder\FactoryInterface;

trait AwareTrait
{
    protected $ActorMapBuilderFactory;

    public function setActorMapBuilderFactory(FactoryInterface $ActorMapBuilderFactory): self
    {
        if ($this->hasActorMapBuilderFactory()) {
            throw new \LogicException('ActorMapBuilderFactory is already set.');
        }
        $this->ActorMapBuilderFactory = $ActorMapBuilderFactory;

        return $this;
    }

    protected function getActorMapBuilderFactory(): FactoryInterface
    {
        if (!$this->hasActorMapBuilderFactory()) {
            throw new \LogicException('ActorMapBuilderFactory is not set.');
        }

        return $this->ActorMapBuilderFactory;
    }

    protected function hasActorMapBuilderFactory(): bool
    {
        return isset($this->ActorMapBuilderFactory);
    }

    protected function unsetActorMapBuilderFactory(): self
    {
        if (!$this->hasActorMapBuilderFactory()) {
            throw new \LogicException('ActorMapBuilderFactory is not set.');
        }
        unset($this->ActorMapBuilderFactory);

        return $this;
    }
}
