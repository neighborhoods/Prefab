<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\MapFactory\Generator\Factory;

use Neighborhoods\Prefab\Actor\MapFactory\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorMapFactoryGeneratorFactory;

    public function setActorMapFactoryGeneratorFactory(FactoryInterface $actorMapFactoryGeneratorFactory): self
    {
        if ($this->hasActorMapFactoryGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorMapFactoryGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabActorMapFactoryGeneratorFactory = $actorMapFactoryGeneratorFactory;

        return $this;
    }

    protected function getActorMapFactoryGeneratorFactory(): FactoryInterface
    {
        if (!$this->hasActorMapFactoryGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorMapFactoryGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabActorMapFactoryGeneratorFactory;
    }

    protected function hasActorMapFactoryGeneratorFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabActorMapFactoryGeneratorFactory);
    }

    protected function unsetActorMapFactoryGeneratorFactory(): self
    {
        if (!$this->hasActorMapFactoryGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorMapFactoryGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabActorMapFactoryGeneratorFactory);

        return $this;
    }
}
