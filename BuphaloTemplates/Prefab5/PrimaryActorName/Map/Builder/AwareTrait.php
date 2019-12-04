<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\Builder;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\BuilderInterface;

trait AwareTrait
{
    protected $ActorMapBuilder;

    public function setActorMapBuilder(BuilderInterface $ActorMapBuilder): self
    {
        if ($this->hasActorMapBuilder()) {
            throw new \LogicException('ActorMapBuilder is already set.');
        }
        $this->ActorMapBuilder = $ActorMapBuilder;

        return $this;
    }

    protected function getActorMapBuilder(): BuilderInterface
    {
        if (!$this->hasActorMapBuilder()) {
            throw new \LogicException('ActorMapBuilder is not set.');
        }

        return $this->ActorMapBuilder;
    }

    protected function hasActorMapBuilder(): bool
    {
        return isset($this->ActorMapBuilder);
    }

    protected function unsetActorMapBuilder(): self
    {
        if (!$this->hasActorMapBuilder()) {
            throw new \LogicException('ActorMapBuilder is not set.');
        }
        unset($this->ActorMapBuilder);

        return $this;
    }
}
