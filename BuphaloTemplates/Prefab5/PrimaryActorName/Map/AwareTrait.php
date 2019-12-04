<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\MapInterface;

trait AwareTrait
{
    protected $PrimaryActorNames;

    public function setPrimaryActorNameMap(MapInterface $PrimaryActorNames): self
    {
        if ($this->hasActorMap()) {
            throw new \LogicException('Actors is already set.');
        }
        $this->PrimaryActorNames = $PrimaryActorNames;

        return $this;
    }

    protected function getPrimaryActorNameMap(): MapInterface
    {
        if (!$this->hasActorMap()) {
            throw new \LogicException('Actors is not set.');
        }

        return $this->PrimaryActorNames;
    }

    protected function hasActorMap(): bool
    {
        return isset($this->PrimaryActorNames);
    }

    protected function unsetPrimaryActorNameMap(): self
    {
        if (!$this->hasActorMap()) {
            throw new \LogicException('Actors is not set.');
        }
        unset($this->PrimaryActorNames);

        return $this;
    }
}
