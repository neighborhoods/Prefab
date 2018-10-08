<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\HttpSkeleton\Generator\Factory;

use Neighborhoods\Prefab\HttpSkeleton\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabHttpSkeletonGeneratorFactory;

    public function setHttpSkeletonGeneratorFactory(FactoryInterface $httpSkeletonGeneratorFactory) : self
    {
        if ($this->hasHttpSkeletonGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabHttpSkeletonGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabHttpSkeletonGeneratorFactory = $httpSkeletonGeneratorFactory;

        return $this;
    }

    protected function getHttpSkeletonGeneratorFactory() : FactoryInterface
    {
        if (!$this->hasHttpSkeletonGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabHttpSkeletonGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabHttpSkeletonGeneratorFactory;
    }

    protected function hasHttpSkeletonGeneratorFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabHttpSkeletonGeneratorFactory);
    }

    protected function unsetHttpSkeletonGeneratorFactory() : self
    {
        if (!$this->hasHttpSkeletonGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabHttpSkeletonGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabHttpSkeletonGeneratorFactory);

        return $this;
    }
}
