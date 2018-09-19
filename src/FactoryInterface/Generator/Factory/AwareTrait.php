<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FactoryInterface\Generator\Factory;

use Neighborhoods\Prefab\FactoryInterface\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabFactoryInterfaceGeneratorFactory;

    public function setFactoryInterfaceGeneratorFactory(FactoryInterface $factoryInterfaceGeneratorFactory) : self
    {
        if ($this->hasFactoryInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryInterfaceGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabFactoryInterfaceGeneratorFactory = $factoryInterfaceGeneratorFactory;

        return $this;
    }

    protected function getFactoryInterfaceGeneratorFactory() : FactoryInterface
    {
        if (!$this->hasFactoryInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryInterfaceGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabFactoryInterfaceGeneratorFactory;
    }

    protected function hasFactoryInterfaceGeneratorFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabFactoryInterfaceGeneratorFactory);
    }

    protected function unsetFactoryInterfaceGeneratorFactory() : self
    {
        if (!$this->hasFactoryInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryInterfaceGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabFactoryInterfaceGeneratorFactory);

        return $this;
    }
}
