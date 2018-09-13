<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Factory\Generator;

use Neighborhoods\Prefab\Factory\GeneratorInterface;

/** @codeCoverageIgnore */
trait Factory
{
    protected $NeighborhoodsPrefabFactoryGenerator;

    public function setFactoryGenerator(GeneratorInterface $FactoryGenerator) : self
    {
        if ($this->hasFactoryGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryGenerator is already set.');
        }
        $this->NeighborhoodsPrefabFactoryGenerator = $FactoryGenerator;

        return $this;
    }

    protected function getFactoryGenerator() : GeneratorInterface
    {
        if (!$this->hasFactoryGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabFactoryGenerator;
    }

    protected function hasFactoryGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabFactoryGenerator);
    }

    protected function unsetFactoryGenerator() : self
    {
        if (!$this->hasFactoryGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabFactoryGenerator);

        return $this;
    }
}
