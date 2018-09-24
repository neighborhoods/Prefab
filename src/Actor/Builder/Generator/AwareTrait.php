<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Builder\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabBuilderGenerator;

    public function setBuilderGenerator(GeneratorInterface $builderGenerator) : self
    {
        if ($this->hasBuilderGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabBuilderGenerator is already set.');
        }
        $this->NeighborhoodsPrefabBuilderGenerator = $builderGenerator;

        return $this;
    }

    protected function getBuilderGenerator() : GeneratorInterface
    {
        if (!$this->hasBuilderGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabBuilderGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabBuilderGenerator;
    }

    protected function hasBuilderGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabBuilderGenerator);
    }

    protected function unsetBuilderGenerator() : self
    {
        if (!$this->hasBuilderGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabBuilderGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabBuilderGenerator);

        return $this;
    }
}
