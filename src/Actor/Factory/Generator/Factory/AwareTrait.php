<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Factory\Generator\Factory;

use Neighborhoods\Prefab\Actor\Factory\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorFactoryGeneratorFactory;

    public function setActorFactoryGeneratorFactory(FactoryInterface $actorFactoryGeneratorFactory): self
    {
        if ($this->hasActorFactoryGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorFactoryGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabActorFactoryGeneratorFactory = $actorFactoryGeneratorFactory;

        return $this;
    }

    protected function getActorFactoryGeneratorFactory(): FactoryInterface
    {
        if (!$this->hasActorFactoryGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorFactoryGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabActorFactoryGeneratorFactory;
    }

    protected function hasActorFactoryGeneratorFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabActorFactoryGeneratorFactory);
    }

    protected function unsetActorFactoryGeneratorFactory(): self
    {
        if (!$this->hasActorFactoryGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorFactoryGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabActorFactoryGeneratorFactory);

        return $this;
    }
}
