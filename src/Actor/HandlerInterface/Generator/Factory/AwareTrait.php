<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\HandlerInterface\Generator\Factory;

use Neighborhoods\Prefab\Actor\HandlerInterface\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorHandlerInterfaceGeneratorFactory;

    public function setActorHandlerInterfaceGeneratorFactory(FactoryInterface $actorHandlerInterfaceGeneratorFactory): self
    {
        if ($this->hasActorHandlerInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorHandlerInterfaceGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabActorHandlerInterfaceGeneratorFactory = $actorHandlerInterfaceGeneratorFactory;

        return $this;
    }

    protected function getActorHandlerInterfaceGeneratorFactory(): FactoryInterface
    {
        if (!$this->hasActorHandlerInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorHandlerInterfaceGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabActorHandlerInterfaceGeneratorFactory;
    }

    protected function hasActorHandlerInterfaceGeneratorFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabActorHandlerInterfaceGeneratorFactory);
    }

    protected function unsetActorHandlerInterfaceGeneratorFactory(): self
    {
        if (!$this->hasActorHandlerInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorHandlerInterfaceGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabActorHandlerInterfaceGeneratorFactory);

        return $this;
    }
}
