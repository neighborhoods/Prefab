<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Repository\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabRepositoryGenerator;

    public function setRepositoryGenerator(GeneratorInterface $repositoryGenerator) : self
    {
        if ($this->hasRepositoryGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabRepositoryGenerator is already set.');
        }
        $this->NeighborhoodsPrefabRepositoryGenerator = $repositoryGenerator;

        return $this;
    }

    protected function getRepositoryGenerator() : GeneratorInterface
    {
        if (!$this->hasRepositoryGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabRepositoryGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabRepositoryGenerator;
    }

    protected function hasRepositoryGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabRepositoryGenerator);
    }

    protected function unsetRepositoryGenerator() : self
    {
        if (!$this->hasRepositoryGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabRepositoryGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabRepositoryGenerator);

        return $this;
    }
}
