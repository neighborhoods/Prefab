<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabFitness\Factory;

use Neighborhoods\PrefabFitness\FactoryInterface;

/** @codeCoverageIgnore */
trait Factory
{
    protected $NeighborhoodsPrefabFitnessFactory;

    public function setFactory(FactoryInterface $Factory) : self
    {
        if ($this->hasFactory()) {
            throw new \LogicException('NeighborhoodsPrefabFitnessFactory is already set.');
        }
        $this->NeighborhoodsPrefabFitnessFactory = $Factory;

        return $this;
    }

    protected function getFactory() : FactoryInterface
    {
        if (!$this->hasFactory()) {
            throw new \LogicException('NeighborhoodsPrefabFitnessFactory is not set.');
        }

        return $this->NeighborhoodsPrefabFitnessFactory;
    }

    protected function hasFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabFitnessFactory);
    }

    protected function unsetFactory() : self
    {
        if (!$this->hasFactory()) {
            throw new \LogicException('NeighborhoodsPrefabFitnessFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabFitnessFactory);

        return $this;
    }
}
