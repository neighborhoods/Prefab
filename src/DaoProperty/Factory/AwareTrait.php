<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty\Factory;

use Neighborhoods\Prefab\DaoProperty\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabDaoPropertyFactory;

    public function setDaoPropertyFactory(FactoryInterface $daoPropertyFactory) : self
    {
        if ($this->hasDaoPropertyFactory()) {
            throw new \LogicException('NeighborhoodsPrefabDaoPropertyFactory is already set.');
        }
        $this->NeighborhoodsPrefabDaoPropertyFactory = $daoPropertyFactory;

        return $this;
    }

    protected function getDaoPropertyFactory() : FactoryInterface
    {
        if (!$this->hasDaoPropertyFactory()) {
            throw new \LogicException('NeighborhoodsPrefabDaoPropertyFactory is not set.');
        }

        return $this->NeighborhoodsPrefabDaoPropertyFactory;
    }

    protected function hasDaoPropertyFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabDaoPropertyFactory);
    }

    protected function unsetDaoPropertyFactory() : self
    {
        if (!$this->hasDaoPropertyFactory()) {
            throw new \LogicException('NeighborhoodsPrefabDaoPropertyFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabDaoPropertyFactory);

        return $this;
    }
}
