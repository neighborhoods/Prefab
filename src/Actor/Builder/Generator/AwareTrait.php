<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Builder\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorBuilderGenerator;

    public function setActorBuilderGenerator(GeneratorInterface $actorBuilderGenerator): self
    {
        if ($this->hasActorBuilderGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorBuilderGenerator is already set.');
        }
        $this->NeighborhoodsPrefabActorBuilderGenerator = $actorBuilderGenerator;

        return $this;
    }

    protected function getActorBuilderGenerator(): GeneratorInterface
    {
        if (!$this->hasActorBuilderGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorBuilderGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabActorBuilderGenerator;
    }

    protected function hasActorBuilderGenerator(): bool
    {
        return isset($this->NeighborhoodsPrefabActorBuilderGenerator);
    }

    protected function unsetActorBuilderGenerator(): self
    {
        if (!$this->hasActorBuilderGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorBuilderGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabActorBuilderGenerator);

        return $this;
    }
}
