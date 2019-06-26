<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Builder;

use Neighborhoods\Bradfab\Template\Actor\BuilderInterface;

trait AwareTrait
{
    protected $ActorBuilder;

    public function setActorBuilder(BuilderInterface $ActorBuilder): self
    {
        if ($this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is already set.');
        }
        $this->ActorBuilder = $ActorBuilder;

        return $this;
    }

    protected function getActorBuilder(): BuilderInterface
    {
        if (!$this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is not set.');
        }

        return $this->ActorBuilder;
    }

    protected function hasActorBuilder(): bool
    {
        return isset($this->ActorBuilder);
    }

    protected function unsetActorBuilder(): self
    {
        if (!$this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is not set.');
        }
        unset($this->ActorBuilder);

        return $this;
    }
}
