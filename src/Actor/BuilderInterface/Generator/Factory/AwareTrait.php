<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\BuilderInterface\Generator\Factory;

use Neighborhoods\Prefab\Actor\BuilderInterface\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorBuilderInterfaceGeneratorFactory;

    public function setActorBuilderInterfaceGeneratorFactory(FactoryInterface $actorBuilderInterfaceGeneratorFactory): self
    {
        if ($this->hasActorBuilderInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorBuilderInterfaceGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabActorBuilderInterfaceGeneratorFactory = $actorBuilderInterfaceGeneratorFactory;

        return $this;
    }

    protected function getActorBuilderInterfaceGeneratorFactory(): FactoryInterface
    {
        if (!$this->hasActorBuilderInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorBuilderInterfaceGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabActorBuilderInterfaceGeneratorFactory;
    }

    protected function hasActorBuilderInterfaceGeneratorFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabActorBuilderInterfaceGeneratorFactory);
    }

    protected function unsetActorBuilderInterfaceGeneratorFactory(): self
    {
        if (!$this->hasActorBuilderInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorBuilderInterfaceGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabActorBuilderInterfaceGeneratorFactory);

        return $this;
    }
}
