<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\HttpSkeleton\Generator;

use Neighborhoods\Prefab\HttpSkeleton\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabHttpSkeletonGenerator;

    public function setHttpSkeletonGenerator(GeneratorInterface $httpSkeletonGenerator) : self
    {
        if ($this->hasHttpSkeletonGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabHttpSkeletonGenerator is already set.');
        }
        $this->NeighborhoodsPrefabHttpSkeletonGenerator = $httpSkeletonGenerator;

        return $this;
    }

    protected function getHttpSkeletonGenerator() : GeneratorInterface
    {
        if (!$this->hasHttpSkeletonGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabHttpSkeletonGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabHttpSkeletonGenerator;
    }

    protected function hasHttpSkeletonGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabHttpSkeletonGenerator);
    }

    protected function unsetHttpSkeletonGenerator() : self
    {
        if (!$this->hasHttpSkeletonGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabHttpSkeletonGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabHttpSkeletonGenerator);

        return $this;
    }
}
