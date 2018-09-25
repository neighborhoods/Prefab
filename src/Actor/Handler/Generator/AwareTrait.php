<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Handler\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorHandlerGenerator;

    public function setActorHandlerGenerator(GeneratorInterface $actorHandlerGenerator): self
    {
        if ($this->hasActorHandlerGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorHandlerGenerator is already set.');
        }
        $this->NeighborhoodsPrefabActorHandlerGenerator = $actorHandlerGenerator;

        return $this;
    }

    protected function getActorHandlerGenerator(): GeneratorInterface
    {
        if (!$this->hasActorHandlerGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorHandlerGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabActorHandlerGenerator;
    }

    protected function hasActorHandlerGenerator(): bool
    {
        return isset($this->NeighborhoodsPrefabActorHandlerGenerator);
    }

    protected function unsetActorHandlerGenerator(): self
    {
        if (!$this->hasActorHandlerGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorHandlerGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabActorHandlerGenerator);

        return $this;
    }
}
