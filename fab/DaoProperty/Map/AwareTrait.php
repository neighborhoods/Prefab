<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty\Map;

use Neighborhoods\Prefab\DaoProperty\MapInterface;

trait AwareTrait
{
    protected $DaoPropertys;

    public function setDaoPropertyMap(MapInterface $DaoPropertys): self
    {
        if ($this->hasDaoPropertyMap()) {
            throw new \LogicException('DaoPropertyMap is already set.');
        }
        $this->DaoPropertys = $DaoPropertys;

        return $this;
    }

    protected function getDaoPropertyMap(): MapInterface
    {
        if (!$this->hasDaoPropertyMap()) {
            throw new \LogicException('DaoPropertyMap is not set.');
        }

        return $this->DaoPropertys;
    }

    protected function hasDaoPropertyMap(): bool
    {
        return isset($this->DaoPropertys);
    }

    protected function unsetDaoPropertyMap(): self
    {
        if (!$this->hasDaoPropertyMap()) {
            throw new \LogicException('DaoPropertyMap is not set.');
        }
        unset($this->DaoPropertys);

        return $this;
    }
}
