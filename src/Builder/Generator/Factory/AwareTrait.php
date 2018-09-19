<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Builder\Generator\Factory;

use Neighborhoods\Prefab\Builder\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabBuilderGeneratorFactory;

    public function setBuilderGeneratorFactory(FactoryInterface $builderGeneratorFactory) : self
    {
        if ($this->hasBuilderGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuilderGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabBuilderGeneratorFactory = $builderGeneratorFactory;

        return $this;
    }

    protected function getBuilderGeneratorFactory() : FactoryInterface
    {
        if (!$this->hasBuilderGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuilderGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabBuilderGeneratorFactory;
    }

    protected function hasBuilderGeneratorFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabBuilderGeneratorFactory);
    }

    protected function unsetBuilderGeneratorFactory() : self
    {
        if (!$this->hasBuilderGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuilderGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabBuilderGeneratorFactory);

        return $this;
    }
}
