<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Builder\Factory;

use Neighborhoods\Bradfab\Template\Actor\Builder\FactoryInterface;

trait AwareTrait
{
    protected $ActorBuilderFactory;

    public function setActorBuilderFactory(FactoryInterface $ActorBuilderFactory): self
    {
        if ($this->hasActorBuilderFactory()) {
            throw new \LogicException('ActorBuilderFactory is already set.');
        }
        $this->ActorBuilderFactory = $ActorBuilderFactory;

        return $this;
    }

    protected function getActorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasActorBuilderFactory()) {
            throw new \LogicException('ActorBuilderFactory is not set.');
        }

        return $this->ActorBuilderFactory;
    }

    protected function hasActorBuilderFactory(): bool
    {
        return isset($this->ActorBuilderFactory);
    }

    protected function unsetActorBuilderFactory(): self
    {
        if (!$this->hasActorBuilderFactory()) {
            throw new \LogicException('ActorBuilderFactory is not set.');
        }
        unset($this->ActorBuilderFactory);

        return $this;
    }
}
