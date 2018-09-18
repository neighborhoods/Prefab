<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FactoryInterface\Generator;

use Neighborhoods\Prefab\FactoryInterface\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabFactoryInterfaceGenerator;

    public function setFactoryInterfaceGenerator(GeneratorInterface $factoryInterfaceGenerator) : self
    {
        if ($this->hasFactoryInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryInterfaceGenerator is already set.');
        }
        $this->NeighborhoodsPrefabFactoryInterfaceGenerator = $factoryInterfaceGenerator;

        return $this;
    }

    protected function getFactoryInterfaceGenerator() : GeneratorInterface
    {
        if (!$this->hasFactoryInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryInterfaceGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabFactoryInterfaceGenerator;
    }

    protected function hasFactoryInterfaceGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabFactoryInterfaceGenerator);
    }

    protected function unsetFactoryInterfaceGenerator() : self
    {
        if (!$this->hasFactoryInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryInterfaceGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabFactoryInterfaceGenerator);

        return $this;
    }
}
