<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\RepositoryInterface\Generator\Factory;

use Neighborhoods\Prefab\Actor\RepositoryInterface\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorRepositoryInterfaceGeneratorFactory;

    public function setActorRepositoryInterfaceGeneratorFactory(FactoryInterface $actorRepositoryInterfaceGeneratorFactory): self
    {
        if ($this->hasActorRepositoryInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorRepositoryInterfaceGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabActorRepositoryInterfaceGeneratorFactory = $actorRepositoryInterfaceGeneratorFactory;

        return $this;
    }

    protected function getActorRepositoryInterfaceGeneratorFactory(): FactoryInterface
    {
        if (!$this->hasActorRepositoryInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorRepositoryInterfaceGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabActorRepositoryInterfaceGeneratorFactory;
    }

    protected function hasActorRepositoryInterfaceGeneratorFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabActorRepositoryInterfaceGeneratorFactory);
    }

    protected function unsetActorRepositoryInterfaceGeneratorFactory(): self
    {
        if (!$this->hasActorRepositoryInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorRepositoryInterfaceGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabActorRepositoryInterfaceGeneratorFactory);

        return $this;
    }
}
