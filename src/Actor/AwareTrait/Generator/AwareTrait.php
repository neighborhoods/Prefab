<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\AwareTrait\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorAwareTraitGenerator;

    public function setActorAwareTraitGenerator(GeneratorInterface $actorAwareTraitGenerator): self
    {
        if ($this->hasActorAwareTraitGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorAwareTraitGenerator is already set.');
        }
        $this->NeighborhoodsPrefabActorAwareTraitGenerator = $actorAwareTraitGenerator;

        return $this;
    }

    protected function getActorAwareTraitGenerator(): GeneratorInterface
    {
        if (!$this->hasActorAwareTraitGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorAwareTraitGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabActorAwareTraitGenerator;
    }

    protected function hasActorAwareTraitGenerator(): bool
    {
        return isset($this->NeighborhoodsPrefabActorAwareTraitGenerator);
    }

    protected function unsetActorAwareTraitGenerator(): self
    {
        if (!$this->hasActorAwareTraitGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabActorAwareTraitGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabActorAwareTraitGenerator);

        return $this;
    }
}
