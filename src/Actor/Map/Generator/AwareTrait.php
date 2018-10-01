<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Map\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabMapGenerator;

    public function setMapGenerator(GeneratorInterface $mapGenerator): self
    {
        if ($this->hasMapGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabMapGenerator is already set.');
        }
        $this->NeighborhoodsPrefabMapGenerator = $mapGenerator;

        return $this;
    }

    protected function getMapGenerator(): GeneratorInterface
    {
        if (!$this->hasMapGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabMapGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabMapGenerator;
    }

    protected function hasMapGenerator(): bool
    {
        return isset($this->NeighborhoodsPrefabMapGenerator);
    }

    protected function unsetMapGenerator(): self
    {
        if (!$this->hasMapGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabMapGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabMapGenerator);

        return $this;
    }
}
