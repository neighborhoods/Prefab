<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty;

use Neighborhoods\Prefab\DaoPropertyInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabDaoProperty;

    public function setDaoProperty(DaoPropertyInterface $daoProperty) : self
    {
        if ($this->hasDaoProperty()) {
            throw new \LogicException('NeighborhoodsPrefabDaoProperty is already set.');
        }
        $this->NeighborhoodsPrefabDaoProperty = $daoProperty;

        return $this;
    }

    protected function getDaoProperty() : DaoPropertyInterface
    {
        if (!$this->hasDaoProperty()) {
            throw new \LogicException('NeighborhoodsPrefabDaoProperty is not set.');
        }

        return $this->NeighborhoodsPrefabDaoProperty;
    }

    protected function hasDaoProperty() : bool
    {
        return isset($this->NeighborhoodsPrefabDaoProperty);
    }

    protected function unsetDaoProperty() : self
    {
        if (!$this->hasDaoProperty()) {
            throw new \LogicException('NeighborhoodsPrefabDaoProperty is not set.');
        }
        unset($this->NeighborhoodsPrefabDaoProperty);

        return $this;
    }
}
