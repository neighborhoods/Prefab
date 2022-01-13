<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Map;

use Neighborhoods\Prefab\Actor\MapInterface;

trait AwareTrait
{
    protected $Actors;

    public function setActorMap(MapInterface $Actors): self
    {
        if ($this->hasActorMap()) {
            throw new \LogicException('ActorMap is already set.');
        }
        $this->Actors = $Actors;

        return $this;
    }

    protected function getActorMap(): MapInterface
    {
        if (!$this->hasActorMap()) {
            throw new \LogicException('ActorMap is not set.');
        }

        return $this->Actors;
    }

    protected function hasActorMap(): bool
    {
        return isset($this->Actors);
    }

    protected function unsetActorMap(): self
    {
        if (!$this->hasActorMap()) {
            throw new \LogicException('ActorMap is not set.');
        }
        unset($this->Actors);

        return $this;
    }
}
