<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Repository\Generator\Factory;

use Neighborhoods\Prefab\Actor\Repository\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorRepositoryGeneratorFactory;

    public function setActorRepositoryGeneratorFactory(FactoryInterface $actorRepositoryGeneratorFactory): self
    {
        if ($this->hasActorRepositoryGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorRepositoryGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabActorRepositoryGeneratorFactory = $actorRepositoryGeneratorFactory;

        return $this;
    }

    protected function getActorRepositoryGeneratorFactory(): FactoryInterface
    {
        if (!$this->hasActorRepositoryGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorRepositoryGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabActorRepositoryGeneratorFactory;
    }

    protected function hasActorRepositoryGeneratorFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabActorRepositoryGeneratorFactory);
    }

    protected function unsetActorRepositoryGeneratorFactory(): self
    {
        if (!$this->hasActorRepositoryGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorRepositoryGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabActorRepositoryGeneratorFactory);

        return $this;
    }
}
