<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabFitness\FactoryInterface;

use Neighborhoods\PrefabFitness\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabFitnessFactoryInterface;

    public function setFactoryInterface(FactoryInterface $FactoryInterface ) : self
    {
        if ($this->hasFactoryInterface()) {
            throw new \LogicException('NeighborhoodsPrefabFitnessFactoryInterface is already set.');
        }
        $this->NeighborhoodsPrefabFitnessFactoryInterface = $FactoryInterface;

        return $this;
    }

    protected function getFactoryInterface() : FactoryInterface
    {
        if (!$this->hasFactoryInterface()) {
            throw new \LogicException('NeighborhoodsPrefabFitnessFactoryInterface is not set.');
        }

        return $this->NeighborhoodsPrefabFitnessFactoryInterface;
    }

    protected function hasFactoryInterface() : bool
    {
        return isset($this->NeighborhoodsPrefabFitnessFactoryInterface );
    }

    protected function unsetFactoryInterface() : self
    {
        if (!$this->hasFactoryInterface()) {
            throw new \LogicException('NeighborhoodsPrefabFitnessFactoryInterface is not set.');
        }
        unset($this->NeighborhoodsPrefabFitnessFactoryInterface );

        return $this;
    }
}
