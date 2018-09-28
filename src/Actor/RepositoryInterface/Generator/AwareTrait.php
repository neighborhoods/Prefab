<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\RepositoryInterface\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorRepositoryInterfaceGenerator;

    public function setActorRepositoryInterfaceGenerator(GeneratorInterface $actorRepositoryInterfaceGenerator): self
    {
        if ($this->hasActorRepositoryInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorRepositoryInterfaceGenerator is already set.');
        }
        $this->NeighborhoodsPrefabActorRepositoryInterfaceGenerator = $actorRepositoryInterfaceGenerator;

        return $this;
    }

    protected function getActorRepositoryInterfaceGenerator(): GeneratorInterface
    {
        if (!$this->hasActorRepositoryInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorRepositoryInterfaceGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabActorRepositoryInterfaceGenerator;
    }

    protected function hasActorRepositoryInterfaceGenerator(): bool
    {
        return isset($this->NeighborhoodsPrefabActorRepositoryInterfaceGenerator);
    }

    protected function unsetActorRepositoryInterfaceGenerator(): self
    {
        if (!$this->hasActorRepositoryInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorRepositoryInterfaceGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabActorRepositoryInterfaceGenerator);

        return $this;
    }
}
