<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\HandlerActor\Factory;

use Neighborhoods\Prefab\Bradfab\Template\HandlerActor\FactoryInterface;

trait AwareTrait
{
    protected $HandlerActorFactory;

    public function setHandlerActorFactory(FactoryInterface $HandlerActorFactory): self
    {
        if ($this->hasHandlerActorFactory()) {
            throw new \LogicException('HandlerActorFactory is already set.');
        }
        $this->HandlerActorFactory = $HandlerActorFactory;

        return $this;
    }

    protected function getHandlerActorFactory(): FactoryInterface
    {
        if (!$this->hasHandlerActorFactory()) {
            throw new \LogicException('HandlerActorFactory is not set.');
        }

        return $this->HandlerActorFactory;
    }

    protected function hasHandlerActorFactory(): bool
    {
        return isset($this->HandlerActorFactory);
    }

    protected function unsetHandlerActorFactory(): self
    {
        if (!$this->hasHandlerActorFactory()) {
            throw new \LogicException('HandlerActorFactory is not set.');
        }
        unset($this->HandlerActorFactory);

        return $this;
    }
}
