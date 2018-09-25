<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Handler\Generator\Factory;

use Neighborhoods\Prefab\Actor\Handler\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorHandlerGeneratorFactory;

    public function setActorHandlerGeneratorFactory(FactoryInterface $actorHandlerGeneratorFactory): self
    {
        if ($this->hasActorHandlerGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorHandlerGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabActorHandlerGeneratorFactory = $actorHandlerGeneratorFactory;

        return $this;
    }

    protected function getActorHandlerGeneratorFactory(): FactoryInterface
    {
        if (!$this->hasActorHandlerGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorHandlerGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabActorHandlerGeneratorFactory;
    }

    protected function hasActorHandlerGeneratorFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabActorHandlerGeneratorFactory);
    }

    protected function unsetActorHandlerGeneratorFactory(): self
    {
        if (!$this->hasActorHandlerGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorHandlerGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabActorHandlerGeneratorFactory);

        return $this;
    }
}
