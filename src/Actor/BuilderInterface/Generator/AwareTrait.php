<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\BuilderInterface\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorBuilderInterfaceGenerator;

    public function setActorBuilderInterfaceGenerator(GeneratorInterface $actorBuilderInterfaceGenerator): self
    {
        if ($this->hasActorBuilderInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorBuilderInterfaceGenerator is already set.');
        }
        $this->NeighborhoodsPrefabActorBuilderInterfaceGenerator = $actorBuilderInterfaceGenerator;

        return $this;
    }

    protected function getActorBuilderInterfaceGenerator(): GeneratorInterface
    {
        if (!$this->hasActorBuilderInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorBuilderInterfaceGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabActorBuilderInterfaceGenerator;
    }

    protected function hasActorBuilderInterfaceGenerator(): bool
    {
        return isset($this->NeighborhoodsPrefabActorBuilderInterfaceGenerator);
    }

    protected function unsetActorBuilderInterfaceGenerator(): self
    {
        if (!$this->hasActorBuilderInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorBuilderInterfaceGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabActorBuilderInterfaceGenerator);

        return $this;
    }
}
