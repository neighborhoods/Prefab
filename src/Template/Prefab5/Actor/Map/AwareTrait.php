<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Map;

use Neighborhoods\Bradfab\Template\Actor\MapInterface;

trait AwareTrait
{
    protected $Actors;

    public function setActorMap(MapInterface $Actors): self
    {
        if ($this->hasActorMap()) {
            throw new \LogicException('Actors is already set.');
        }
        $this->Actors = $Actors;

        return $this;
    }

    protected function getActorMap(): MapInterface
    {
        if (!$this->hasActorMap()) {
            throw new \LogicException('Actors is not set.');
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
            throw new \LogicException('Actors is not set.');
        }
        unset($this->Actors);

        return $this;
    }
}
