<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Constant\Map;

use Neighborhoods\Prefab\Constant\MapInterface;

trait AwareTrait
{
    protected $Constants;

    public function setConstantMap(MapInterface $Constants): self
    {
        if ($this->hasActorMap()) {
            throw new \LogicException('Actors is already set.');
        }
        $this->Constants = $Constants;

        return $this;
    }

    protected function getConstantMap(): MapInterface
    {
        if (!$this->hasActorMap()) {
            throw new \LogicException('Actors is not set.');
        }

        return $this->Constants;
    }

    protected function hasActorMap(): bool
    {
        return isset($this->Constants);
    }

    protected function unsetConstantMap(): self
    {
        if (!$this->hasActorMap()) {
            throw new \LogicException('Actors is not set.');
        }
        unset($this->Constants);

        return $this;
    }
}
