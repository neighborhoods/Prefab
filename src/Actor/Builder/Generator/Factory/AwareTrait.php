<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Builder\Generator\Factory;

use Neighborhoods\Prefab\Actor\Builder\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorBuilderGeneratorFactory;

    public function setActorBuilderGeneratorFactory(FactoryInterface $actorBuilderGeneratorFactory): self
    {
        if ($this->hasActorBuilderGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorBuilderGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabActorBuilderGeneratorFactory = $actorBuilderGeneratorFactory;

        return $this;
    }

    protected function getActorBuilderGeneratorFactory(): FactoryInterface
    {
        if (!$this->hasActorBuilderGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorBuilderGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabActorBuilderGeneratorFactory;
    }

    protected function hasActorBuilderGeneratorFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabActorBuilderGeneratorFactory);
    }

    protected function unsetActorBuilderGeneratorFactory(): self
    {
        if (!$this->hasActorBuilderGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorBuilderGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabActorBuilderGeneratorFactory);

        return $this;
    }
}
