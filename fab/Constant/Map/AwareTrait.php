<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Constant\Map;

use Neighborhoods\Prefab\Constant\MapInterface;

trait AwareTrait
{
    protected $Constants;

    public function setConstantMap(MapInterface $Constants): self
    {
        if ($this->hasConstantMap()) {
            throw new \LogicException('Constants is already set.');
        }
        $this->Constants = $Constants;

        return $this;
    }

    protected function getConstantMap(): MapInterface
    {
        if (!$this->hasConstantMap()) {
            throw new \LogicException('Constants is not set.');
        }

        return $this->Constants;
    }

    protected function hasConstantMap(): bool
    {
        return isset($this->Constants);
    }

    protected function unsetConstantMap(): self
    {
        if (!$this->hasConstantMap()) {
            throw new \LogicException('Constants is not set.');
        }
        unset($this->Constants);

        return $this;
    }
}
