<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\Builder;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\BuilderInterface;

trait AwareTrait
{
    protected $PrimaryActorNameMapBuilder;

    public function setPrimaryActorNameMapBuilder(BuilderInterface $PrimaryActorNameMapBuilder): self
    {
        if ($this->hasActorMapBuilder()) {
            throw new \LogicException('ActorMapBuilder is already set.');
        }
        $this->PrimaryActorNameMapBuilder = $PrimaryActorNameMapBuilder;

        return $this;
    }

    protected function getPrimaryActorNameMapBuilder(): BuilderInterface
    {
        if (!$this->hasActorMapBuilder()) {
            throw new \LogicException('ActorMapBuilder is not set.');
        }

        return $this->PrimaryActorNameMapBuilder;
    }

    protected function hasActorMapBuilder(): bool
    {
        return isset($this->PrimaryActorNameMapBuilder);
    }

    protected function unsetPrimaryActorNameMapBuilder(): self
    {
        if (!$this->hasActorMapBuilder()) {
            throw new \LogicException('ActorMapBuilder is not set.');
        }
        unset($this->PrimaryActorNameMapBuilder);

        return $this;
    }
}
