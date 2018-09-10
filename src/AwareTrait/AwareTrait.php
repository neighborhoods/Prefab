<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamples\AwareTrait;

use Neighborhoods\PrefabExamples\AwareTraitInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesAwareTrait;

    public function setAwareTrait(AwareTraitInterface $awareTrait) : self
    {
        if ($this->hasAwareTrait()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesAwareTrait is already set.');
        }
        $this->NeighborhoodsPrefabExamplesAwareTrait = $awareTrait;

        return $this;
    }

    protected function getAwareTrait() : AwareTraitInterface
    {
        if (!$this->hasAwareTrait()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesAwareTrait is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesAwareTrait;
    }

    protected function hasAwareTrait() : bool
    {
        return isset($this->NeighborhoodsPrefabExamplesAwareTrait);
    }

    protected function unsetAwareTrait() : self
    {
        if (!$this->hasAwareTrait()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesAwareTrait is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesAwareTrait);

        return $this;
    }
}
