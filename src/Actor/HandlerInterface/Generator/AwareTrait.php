<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\HandlerInterface\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorHandlerInterfaceGenerator;

    public function setActorHandlerInterfaceGenerator(GeneratorInterface $actorHandlerInterfaceGenerator): self
    {
        if ($this->hasActorHandlerInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorHandlerInterfaceGenerator is already set.');
        }
        $this->NeighborhoodsPrefabActorHandlerInterfaceGenerator = $actorHandlerInterfaceGenerator;

        return $this;
    }

    protected function getActorHandlerInterfaceGenerator(): GeneratorInterface
    {
        if (!$this->hasActorHandlerInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorHandlerInterfaceGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabActorHandlerInterfaceGenerator;
    }

    protected function hasActorHandlerInterfaceGenerator(): bool
    {
        return isset($this->NeighborhoodsPrefabActorHandlerInterfaceGenerator);
    }

    protected function unsetActorHandlerInterfaceGenerator(): self
    {
        if (!$this->hasActorHandlerInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorHandlerInterfaceGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabActorHandlerInterfaceGenerator);

        return $this;
    }
}
