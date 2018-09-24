<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\AwareTrait\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabAwareTraitGenerator;

    public function setAwareTraitGenerator(GeneratorInterface $awareTraitGenerator) : self
    {
        if ($this->hasAwareTraitGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabAwareTraitGenerator is already set.');
        }
        $this->NeighborhoodsPrefabAwareTraitGenerator = $awareTraitGenerator;

        return $this;
    }

    protected function getAwareTraitGenerator() : GeneratorInterface
    {
        if (!$this->hasAwareTraitGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabAwareTraitGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabAwareTraitGenerator;
    }

    protected function hasAwareTraitGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabAwareTraitGenerator);
    }

    protected function unsetAwareTraitGenerator() : self
    {
        if (!$this->hasAwareTraitGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabAwareTraitGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabAwareTraitGenerator);

        return $this;
    }
}
