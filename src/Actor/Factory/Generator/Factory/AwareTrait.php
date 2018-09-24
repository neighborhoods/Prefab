<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Factory\Generator\Factory;

use Neighborhoods\Prefab\Actor\Factory\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabFactoryGeneratorFactory;

    public function setFactoryGeneratorFactory(FactoryInterface $factoryGeneratorFactory) : self
    {
        if ($this->hasFactoryGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabFactoryGeneratorFactory = $factoryGeneratorFactory;

        return $this;
    }

    protected function getFactoryGeneratorFactory() : FactoryInterface
    {
        if (!$this->hasFactoryGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabFactoryGeneratorFactory;
    }

    protected function hasFactoryGeneratorFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabFactoryGeneratorFactory);
    }

    protected function unsetFactoryGeneratorFactory() : self
    {
        if (!$this->hasFactoryGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabFactoryGeneratorFactory);

        return $this;
    }
}
