<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Builder;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\BuilderInterface;

trait AwareTrait
{
    protected $PrimaryActorNameBuilder;

    public function setPrimaryActorNameBuilder(BuilderInterface $PrimaryActorNameBuilder): self
    {
        if ($this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is already set.');
        }
        $this->PrimaryActorNameBuilder = $PrimaryActorNameBuilder;

        return $this;
    }

    protected function getPrimaryActorNameBuilder(): BuilderInterface
    {
        if (!$this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is not set.');
        }

        return $this->PrimaryActorNameBuilder;
    }

    protected function hasActorBuilder(): bool
    {
        return isset($this->PrimaryActorNameBuilder);
    }

    protected function unsetPrimaryActorNameBuilder(): self
    {
        if (!$this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is not set.');
        }
        unset($this->PrimaryActorNameBuilder);

        return $this;
    }
}
