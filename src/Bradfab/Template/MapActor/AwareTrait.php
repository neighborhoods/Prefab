<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\MapActor;

use Neighborhoods\Prefab\Bradfab\Template\MapActorInterface;

trait AwareTrait
{
    protected $MapActor;

    public function setMapActor(MapActorInterface $MapActor): self
    {
        if ($this->hasMapActor()) {
            throw new \LogicException('MapActor is already set.');
        }
        $this->MapActor = $MapActor;

        return $this;
    }

    protected function getMapActor(): MapActorInterface
    {
        if (!$this->hasMapActor()) {
            throw new \LogicException('MapActor is not set.');
        }

        return $this->MapActor;
    }

    protected function hasMapActor(): bool
    {
        return isset($this->MapActor);
    }

    protected function unsetMapActor(): self
    {
        if (!$this->hasMapActor()) {
            throw new \LogicException('MapActor is not set.');
        }
        unset($this->MapActor);

        return $this;
    }
}
