<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\MapInterface;

trait AwareTrait
{
    protected $PrimaryActorNames;

    public function setPrimaryActorNameMap(MapInterface $PrimaryActorNames): self
    {
        if ($this->hasPrimaryActorNameMap()) {
            throw new \LogicException('PrimaryActorNameMap is already set.');
        }
        $this->PrimaryActorNames = $PrimaryActorNames;

        return $this;
    }

    protected function getPrimaryActorNameMap(): MapInterface
    {
        if (!$this->hasPrimaryActorNameMap()) {
            throw new \LogicException('PrimaryActorNameMap is not set.');
        }

        return $this->PrimaryActorNames;
    }

    protected function hasPrimaryActorNameMap(): bool
    {
        return isset($this->PrimaryActorNames);
    }

    protected function unsetPrimaryActorNameMap(): self
    {
        if (!$this->hasPrimaryActorNameMap()) {
            throw new \LogicException('PrimaryActorNameMap is not set.');
        }
        unset($this->PrimaryActorNames);

        return $this;
    }
}
