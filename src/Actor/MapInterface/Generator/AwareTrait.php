<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\MapInterface\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabMapInterfaceGenerator;

    public function setMapInterfaceGenerator(GeneratorInterface $mapInterfaceGenerator): self
    {
        if ($this->hasMapInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabMapInterfaceGenerator is already set.');
        }
        $this->NeighborhoodsPrefabMapInterfaceGenerator = $mapInterfaceGenerator;

        return $this;
    }

    protected function getMapInterfaceGenerator(): GeneratorInterface
    {
        if (!$this->hasMapInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabMapInterfaceGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabMapInterfaceGenerator;
    }

    protected function hasMapInterfaceGenerator(): bool
    {
        return isset($this->NeighborhoodsPrefabMapInterfaceGenerator);
    }

    protected function unsetMapInterfaceGenerator(): self
    {
        if (!$this->hasMapInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabMapInterfaceGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabMapInterfaceGenerator);

        return $this;
    }
}
