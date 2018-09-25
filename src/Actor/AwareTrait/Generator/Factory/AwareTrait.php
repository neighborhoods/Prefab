<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\AwareTrait\Generator\Factory;

use Neighborhoods\Prefab\Actor\AwareTrait\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabActorAwareTraitGeneratorFactory;

    public function setActorAwareTraitGeneratorFactory(FactoryInterface $actorAwareTraitGeneratorFactory): self
    {
        if ($this->hasActorAwareTraitGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorAwareTraitGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabActorAwareTraitGeneratorFactory = $actorAwareTraitGeneratorFactory;

        return $this;
    }

    protected function getActorAwareTraitGeneratorFactory(): FactoryInterface
    {
        if (!$this->hasActorAwareTraitGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorAwareTraitGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabActorAwareTraitGeneratorFactory;
    }

    protected function hasActorAwareTraitGeneratorFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabActorAwareTraitGeneratorFactory);
    }

    protected function unsetActorAwareTraitGeneratorFactory(): self
    {
        if (!$this->hasActorAwareTraitGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabActorAwareTraitGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabActorAwareTraitGeneratorFactory);

        return $this;
    }
}
