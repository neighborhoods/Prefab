<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuilderInterface\Generator;

use Neighborhoods\Prefab\BuilderInterface\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabBuilderInterfaceGenerator;

    public function setBuilderInterfaceGenerator(GeneratorInterface $builderInterfaceGenerator) : self
    {
        if ($this->hasBuilderInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabBuilderInterfaceGenerator is already set.');
        }
        $this->NeighborhoodsPrefabBuilderInterfaceGenerator = $builderInterfaceGenerator;

        return $this;
    }

    protected function getBuilderInterfaceGenerator() : GeneratorInterface
    {
        if (!$this->hasBuilderInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabBuilderInterfaceGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabBuilderInterfaceGenerator;
    }

    protected function hasBuilderInterfaceGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabBuilderInterfaceGenerator);
    }

    protected function unsetBuilderInterfaceGenerator() : self
    {
        if (!$this->hasBuilderInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabBuilderInterfaceGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabBuilderInterfaceGenerator);

        return $this;
    }
}
