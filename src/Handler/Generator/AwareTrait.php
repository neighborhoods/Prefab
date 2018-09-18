<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Handler\Generator;

use Neighborhoods\Prefab\Handler\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabHandlerGenerator;

    public function setHandlerGenerator(GeneratorInterface $handlerGenerator) : self
    {
        if ($this->hasHandlerGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabHandlerGenerator is already set.');
        }
        $this->NeighborhoodsPrefabHandlerGenerator = $handlerGenerator;

        return $this;
    }

    protected function getHandlerGenerator() : GeneratorInterface
    {
        if (!$this->hasHandlerGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabHandlerGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabHandlerGenerator;
    }

    protected function hasHandlerGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabHandlerGenerator);
    }

    protected function unsetHandlerGenerator() : self
    {
        if (!$this->hasHandlerGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabHandlerGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabHandlerGenerator);

        return $this;
    }
}
