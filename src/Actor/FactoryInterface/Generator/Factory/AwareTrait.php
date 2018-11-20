<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\FactoryInterface\Generator\Factory;

use Neighborhoods\Prefab\Actor\FactoryInterface\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorFactoryInterfaceGeneratorFactory;

    public function setActorFactoryInterfaceGeneratorFactory(FactoryInterface $actorFactoryInterfaceGeneratorFactory): self
    {
        if ($this->hasActorFactoryInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorFactoryInterfaceGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabActorFactoryInterfaceGeneratorFactory = $actorFactoryInterfaceGeneratorFactory;

        return $this;
    }

    protected function getActorFactoryInterfaceGeneratorFactory(): FactoryInterface
    {
        if (!$this->hasActorFactoryInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorFactoryInterfaceGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabActorFactoryInterfaceGeneratorFactory;
    }

    protected function hasActorFactoryInterfaceGeneratorFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabActorFactoryInterfaceGeneratorFactory);
    }

    protected function unsetActorFactoryInterfaceGeneratorFactory(): self
    {
        if (!$this->hasActorFactoryInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorFactoryInterfaceGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabActorFactoryInterfaceGeneratorFactory);

        return $this;
    }
}
