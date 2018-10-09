<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\DAO\Generator\Factory;

use Neighborhoods\Prefab\Actor\DAO\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorDAOGeneratorFactory;

    public function setActorDAOGeneratorFactory(FactoryInterface $actorDAOGeneratorFactory) : self
    {
        if ($this->hasActorDAOGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorDAOGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabActorDAOGeneratorFactory = $actorDAOGeneratorFactory;

        return $this;
    }

    protected function getActorDAOGeneratorFactory() : FactoryInterface
    {
        if (!$this->hasActorDAOGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorDAOGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabActorDAOGeneratorFactory;
    }

    protected function hasActorDAOGeneratorFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabActorDAOGeneratorFactory);
    }

    protected function unsetActorDAOGeneratorFactory() : self
    {
        if (!$this->hasActorDAOGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorDAOGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabActorDAOGeneratorFactory);

        return $this;
    }
}
