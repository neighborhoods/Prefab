<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\MapFactory\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorMapFactoryGenerator;

    public function setActorMapFactoryGenerator(GeneratorInterface $actorMapFactoryGenerator): self
    {
        if ($this->hasActorMapFactoryGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorMapFactoryGenerator is already set.');
        }
        $this->NeighborhoodsPrefabActorMapFactoryGenerator = $actorMapFactoryGenerator;

        return $this;
    }

    protected function getActorMapFactoryGenerator(): GeneratorInterface
    {
        if (!$this->hasActorMapFactoryGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorMapFactoryGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabActorMapFactoryGenerator;
    }

    protected function hasActorMapFactoryGenerator(): bool
    {
        return isset($this->NeighborhoodsPrefabActorMapFactoryGenerator);
    }

    protected function unsetActorMapFactoryGenerator(): self
    {
        if (!$this->hasActorMapFactoryGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorMapFactoryGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabActorMapFactoryGenerator);

        return $this;
    }
}
