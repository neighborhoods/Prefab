<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabFitness\AwareTrait;

use Neighborhoods\PrefabFitness\AwareTraitInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabFitnessAwareTrait;

    public function setAwareTrait(AwareTraitInterface $awareTrait) : self
    {
        if ($this->hasAwareTrait()) {
            throw new \LogicException('NeighborhoodsPrefabFitnessAwareTrait is already set.');
        }
        $this->NeighborhoodsPrefabFitnessAwareTrait = $awareTrait;

        return $this;
    }

    protected function getAwareTrait() : AwareTraitInterface
    {
        if (!$this->hasAwareTrait()) {
            throw new \LogicException('NeighborhoodsPrefabFitnessAwareTrait is not set.');
        }

        return $this->NeighborhoodsPrefabFitnessAwareTrait;
    }

    protected function hasAwareTrait() : bool
    {
        return isset($this->NeighborhoodsPrefabFitnessAwareTrait);
    }

    protected function unsetAwareTrait() : self
    {
        if (!$this->hasAwareTrait()) {
            throw new \LogicException('NeighborhoodsPrefabFitnessAwareTrait is not set.');
        }
        unset($this->NeighborhoodsPrefabFitnessAwareTrait);

        return $this;
    }
}
