<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\DAOInterface\Generator\Factory;

use Neighborhoods\Prefab\Actor\DAOInterface\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorDAOInterfaceGeneratorFactory;

    public function setActorDAOInterfaceGeneratorFactory(FactoryInterface $actorDAOInterfaceGeneratorFactory) : self
    {
        if ($this->hasActorDAOInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorDAOInterfaceGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabActorDAOInterfaceGeneratorFactory = $actorDAOInterfaceGeneratorFactory;

        return $this;
    }

    protected function getActorDAOInterfaceGeneratorFactory() : FactoryInterface
    {
        if (!$this->hasActorDAOInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorDAOInterfaceGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabActorDAOInterfaceGeneratorFactory;
    }

    protected function hasActorDAOInterfaceGeneratorFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabActorDAOInterfaceGeneratorFactory);
    }

    protected function unsetActorDAOInterfaceGeneratorFactory() : self
    {
        if (!$this->hasActorDAOInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorDAOInterfaceGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabActorDAOInterfaceGeneratorFactory);

        return $this;
    }
}
