<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\FactoryInterface\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorFactoryInterfaceGenerator;

    public function setActorFactoryInterfaceGenerator(GeneratorInterface $actorFactoryInterfaceGenerator): self
    {
        if ($this->hasActorFactoryInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorFactoryInterfaceGenerator is already set.');
        }
        $this->NeighborhoodsPrefabActorFactoryInterfaceGenerator = $actorFactoryInterfaceGenerator;

        return $this;
    }

    protected function getActorFactoryInterfaceGenerator(): GeneratorInterface
    {
        if (!$this->hasActorFactoryInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorFactoryInterfaceGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabActorFactoryInterfaceGenerator;
    }

    protected function hasActorFactoryInterfaceGenerator(): bool
    {
        return isset($this->NeighborhoodsPrefabActorFactoryInterfaceGenerator);
    }

    protected function unsetActorFactoryInterfaceGenerator(): self
    {
        if (!$this->hasActorFactoryInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorFactoryInterfaceGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabActorFactoryInterfaceGenerator);

        return $this;
    }
}
