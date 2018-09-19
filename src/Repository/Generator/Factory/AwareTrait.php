<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Repository\Generator\Factory;

use Neighborhoods\Prefab\Repository\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabRepositoryGeneratorFactory;

    public function setRepositoryGeneratorFactory(FactoryInterface $repositoryGeneratorFactory) : self
    {
        if ($this->hasRepositoryGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabRepositoryGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabRepositoryGeneratorFactory = $repositoryGeneratorFactory;

        return $this;
    }

    protected function getRepositoryGeneratorFactory() : FactoryInterface
    {
        if (!$this->hasRepositoryGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabRepositoryGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabRepositoryGeneratorFactory;
    }

    protected function hasRepositoryGeneratorFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabRepositoryGeneratorFactory);
    }

    protected function unsetRepositoryGeneratorFactory() : self
    {
        if (!$this->hasRepositoryGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabRepositoryGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabRepositoryGeneratorFactory);

        return $this;
    }
}
