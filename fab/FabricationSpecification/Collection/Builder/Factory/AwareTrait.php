<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Collection\Builder\Factory;

use Neighborhoods\Prefab\FabricationSpecification\Collection\Builder\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationCollectionBuilderFactory;

    public function setFabricationSpecificationCollectionBuilderFactory(FactoryInterface $CollectionBuilderFactory): self
    {
        if ($this->hasActorBuilderFactory()) {
            throw new \LogicException('ActorBuilderFactory is already set.');
        }
        $this->FabricationSpecificationCollectionBuilderFactory = $CollectionBuilderFactory;

        return $this;
    }

    protected function getFabricationSpecificationCollectionBuilderFactory(): FactoryInterface
    {
        if (!$this->hasActorBuilderFactory()) {
            throw new \LogicException('ActorBuilderFactory is not set.');
        }

        return $this->FabricationSpecificationCollectionBuilderFactory;
    }

    protected function hasActorBuilderFactory(): bool
    {
        return isset($this->FabricationSpecificationCollectionBuilderFactory);
    }

    protected function unsetFabricationSpecificationCollectionBuilderFactory(): self
    {
        if (!$this->hasActorBuilderFactory()) {
            throw new \LogicException('ActorBuilderFactory is not set.');
        }
        unset($this->FabricationSpecificationCollectionBuilderFactory);

        return $this;
    }
}
