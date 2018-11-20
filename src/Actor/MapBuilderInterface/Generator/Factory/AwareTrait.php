<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\MapBuilderInterface\Generator\Factory;

use Neighborhoods\Prefab\Actor\MapBuilderInterface\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorMapBuilderInterfaceGeneratorFactory;

    public function setActorMapBuilderInterfaceGeneratorFactory(
        FactoryInterface $actorMapBuilderInterfaceGeneratorFactory
    ) : self {
        if ($this->hasActorMapBuilderInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorMapBuilderInterfaceGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabActorMapBuilderInterfaceGeneratorFactory = $actorMapBuilderInterfaceGeneratorFactory;

        return $this;
    }

    protected function getActorMapBuilderInterfaceGeneratorFactory() : FactoryInterface
    {
        if (!$this->hasActorMapBuilderInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorMapBuilderInterfaceGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabActorMapBuilderInterfaceGeneratorFactory;
    }

    protected function hasActorMapBuilderInterfaceGeneratorFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabActorMapBuilderInterfaceGeneratorFactory);
    }

    protected function unsetActorMapBuilderInterfaceGeneratorFactory() : self
    {
        if (!$this->hasActorMapBuilderInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorMapBuilderInterfaceGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabActorMapBuilderInterfaceGeneratorFactory);

        return $this;
    }
}
