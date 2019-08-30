<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\HandlerActor;

use Neighborhoods\Prefab\Bradfab\Template\HandlerActorInterface;

trait AwareTrait
{
    protected $HandlerActor;

    public function setHandlerActor(HandlerActorInterface $HandlerActor): self
    {
        if ($this->hasHandlerActor()) {
            throw new \LogicException('HandlerActor is already set.');
        }
        $this->HandlerActor = $HandlerActor;

        return $this;
    }

    protected function getHandlerActor(): HandlerActorInterface
    {
        if (!$this->hasHandlerActor()) {
            throw new \LogicException('HandlerActor is not set.');
        }

        return $this->HandlerActor;
    }

    protected function hasHandlerActor(): bool
    {
        return isset($this->HandlerActor);
    }

    protected function unsetHandlerActor(): self
    {
        if (!$this->hasHandlerActor()) {
            throw new \LogicException('HandlerActor is not set.');
        }
        unset($this->HandlerActor);

        return $this;
    }
}
