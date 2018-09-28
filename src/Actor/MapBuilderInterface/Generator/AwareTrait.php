<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\MapBuilderInterface\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorMapBuilderInterfaceGenerator;

    public function setActorMapBuilderInterfaceGenerator(GeneratorInterface $actorMapBuilderInterfaceGenerator) : self
    {
        if ($this->hasActorMapBuilderInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorMapBuilderInterfaceGenerator is already set.');
        }
        $this->NeighborhoodsPrefabActorMapBuilderInterfaceGenerator = $actorMapBuilderInterfaceGenerator;

        return $this;
    }

    protected function getActorMapBuilderInterfaceGenerator() : GeneratorInterface
    {
        if (!$this->hasActorMapBuilderInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorMapBuilderInterfaceGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabActorMapBuilderInterfaceGenerator;
    }

    protected function hasActorMapBuilderInterfaceGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabActorMapBuilderInterfaceGenerator);
    }

    protected function unsetActorMapBuilderInterfaceGenerator() : self
    {
        if (!$this->hasActorMapBuilderInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorMapBuilderInterfaceGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabActorMapBuilderInterfaceGenerator);

        return $this;
    }
}
