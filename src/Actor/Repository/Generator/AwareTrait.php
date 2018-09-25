<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Repository\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorRepositoryGenerator;

    public function setActorRepositoryGenerator(GeneratorInterface $actorRepositoryGenerator): self
    {
        if ($this->hasActorRepositoryGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorRepositoryGenerator is already set.');
        }
        $this->NeighborhoodsPrefabActorRepositoryGenerator = $actorRepositoryGenerator;

        return $this;
    }

    protected function getActorRepositoryGenerator(): GeneratorInterface
    {
        if (!$this->hasActorRepositoryGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorRepositoryGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabActorRepositoryGenerator;
    }

    protected function hasActorRepositoryGenerator(): bool
    {
        return isset($this->NeighborhoodsPrefabActorRepositoryGenerator);
    }

    protected function unsetActorRepositoryGenerator(): self
    {
        if (!$this->hasActorRepositoryGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorRepositoryGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabActorRepositoryGenerator);

        return $this;
    }
}
