<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Factory\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorFactoryGenerator;

    public function setActorFactoryGenerator(GeneratorInterface $actorFactoryGenerator): self
    {
        if ($this->hasActorFactoryGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorFactoryGenerator is already set.');
        }
        $this->NeighborhoodsPrefabActorFactoryGenerator = $actorFactoryGenerator;

        return $this;
    }

    protected function getActorFactoryGenerator(): GeneratorInterface
    {
        if (!$this->hasActorFactoryGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorFactoryGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabActorFactoryGenerator;
    }

    protected function hasActorFactoryGenerator(): bool
    {
        return isset($this->NeighborhoodsPrefabActorFactoryGenerator);
    }

    protected function unsetActorFactoryGenerator(): self
    {
        if (!$this->hasActorFactoryGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorFactoryGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabActorFactoryGenerator);

        return $this;
    }
}
