<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorNameInterface;

trait AwareTrait
{
    protected $PrimaryActorName;

    public function setPrimaryActorName(PrimaryActorNameInterface $PrimaryActorName): self
    {
        if ($this->hasActor()) {
            throw new \LogicException('Actor is already set.');
        }
        $this->PrimaryActorName = $PrimaryActorName;

        return $this;
    }

    protected function getPrimaryActorName(): PrimaryActorNameInterface
    {
        if (!$this->hasActor()) {
            throw new \LogicException('Actor is not set.');
        }

        return $this->PrimaryActorName;
    }

    protected function hasActor(): bool
    {
        return isset($this->PrimaryActorName);
    }

    protected function unsetPrimaryActorName(): self
    {
        if (!$this->hasActor()) {
            throw new \LogicException('Actor is not set.');
        }
        unset($this->PrimaryActorName);

        return $this;
    }
}
