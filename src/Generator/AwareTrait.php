<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Generator;

use Neighborhoods\Prefab\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabGenerator;

    public function setGenerator(GeneratorInterface $generator) : self
    {
        if ($this->hasGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabGenerator is already set.');
        }
        $this->NeighborhoodsPrefabGenerator = $generator;

        return $this;
    }

    protected function getGenerator() : GeneratorInterface
    {
        if (!$this->hasGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabGenerator;
    }

    protected function hasGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabGenerator);
    }

    protected function unsetGenerator() : self
    {
        if (!$this->hasGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabGenerator);

        return $this;
    }
}
