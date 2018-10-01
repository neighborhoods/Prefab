<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Zend\Code\Generator\TraitGenerator;

use Zend\Code\Generator\TraitGenerator;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabZendCodeGeneratorTraitGenerator;

    public function setZendCodeGeneratorTraitGenerator(TraitGenerator $zendCodeGeneratorTraitGenerator) : self
    {
        if ($this->hasZendCodeGeneratorTraitGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabZendCodeGeneratorTraitGenerator is already set.');
        }
        $this->NeighborhoodsPrefabZendCodeGeneratorTraitGenerator = $zendCodeGeneratorTraitGenerator;

        return $this;
    }

    protected function getZendCodeGeneratorTraitGenerator() : TraitGenerator
    {
        if (!$this->hasZendCodeGeneratorTraitGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabZendCodeGeneratorTraitGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabZendCodeGeneratorTraitGenerator;
    }

    protected function hasZendCodeGeneratorTraitGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabZendCodeGeneratorTraitGenerator);
    }

    protected function unsetZendCodeGeneratorTraitGenerator() : self
    {
        if (!$this->hasZendCodeGeneratorTraitGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabZendCodeGeneratorTraitGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabZendCodeGeneratorTraitGenerator);

        return $this;
    }
}
