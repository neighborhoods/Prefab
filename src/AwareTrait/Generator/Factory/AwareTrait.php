<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AwareTrait\Generator\Factory;

use Neighborhoods\Prefab\AwareTrait\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabAwareTraitGeneratorFactory;

    public function setAwareTraitGeneratorFactory(FactoryInterface $awareTraitGeneratorFactory) : self
    {
        if ($this->hasAwareTraitGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabAwareTraitGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabAwareTraitGeneratorFactory = $awareTraitGeneratorFactory;

        return $this;
    }

    protected function getAwareTraitGeneratorFactory() : FactoryInterface
    {
        if (!$this->hasAwareTraitGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabAwareTraitGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabAwareTraitGeneratorFactory;
    }

    protected function hasAwareTraitGeneratorFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabAwareTraitGeneratorFactory);
    }

    protected function unsetAwareTraitGeneratorFactory() : self
    {
        if (!$this->hasAwareTraitGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabAwareTraitGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabAwareTraitGeneratorFactory);

        return $this;
    }
}
