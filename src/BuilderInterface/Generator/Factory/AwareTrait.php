<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuilderInterface\Generator\Factory;

use Neighborhoods\Prefab\BuilderInterface\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabBuilderInterfaceGeneratorFactory;

    public function setBuilderInterfaceGeneratorFactory(FactoryInterface $builderInterfaceGeneratorFactory) : self
    {
        if ($this->hasBuilderInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuilderInterfaceGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabBuilderInterfaceGeneratorFactory = $builderInterfaceGeneratorFactory;

        return $this;
    }

    protected function getBuilderInterfaceGeneratorFactory() : FactoryInterface
    {
        if (!$this->hasBuilderInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuilderInterfaceGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabBuilderInterfaceGeneratorFactory;
    }

    protected function hasBuilderInterfaceGeneratorFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabBuilderInterfaceGeneratorFactory);
    }

    protected function unsetBuilderInterfaceGeneratorFactory() : self
    {
        if (!$this->hasBuilderInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuilderInterfaceGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabBuilderInterfaceGeneratorFactory);

        return $this;
    }
}
