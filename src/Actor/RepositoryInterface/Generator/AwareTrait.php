<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\RepositoryInterface\Generator;

use Neighborhoods\Prefab\Actor\RepositoryInterface\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabRepositoryInterfaceGenerator;

    public function setRepositoryInterfaceGenerator(GeneratorInterface $repositoryInterfaceGenerator) : self
    {
        if ($this->hasRepositoryInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabRepositoryInterfaceGenerator is already set.');
        }
        $this->NeighborhoodsPrefabRepositoryInterfaceGenerator = $repositoryInterfaceGenerator;

        return $this;
    }

    protected function getRepositoryInterfaceGenerator() : GeneratorInterface
    {
        if (!$this->hasRepositoryInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabRepositoryInterfaceGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabRepositoryInterfaceGenerator;
    }

    protected function hasRepositoryInterfaceGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabRepositoryInterfaceGenerator);
    }

    protected function unsetRepositoryInterfaceGenerator() : self
    {
        if (!$this->hasRepositoryInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabRepositoryInterfaceGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabRepositoryInterfaceGenerator);

        return $this;
    }
}
