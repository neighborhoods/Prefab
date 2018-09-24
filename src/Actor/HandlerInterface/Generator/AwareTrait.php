<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\HandlerInterface\Generator;

use Neighborhoods\Prefab\Actor\HandlerInterface\GeneratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabHandlerInterfaceGenerator;

    public function setHandlerInterfaceGenerator(GeneratorInterface $handlerInterfaceGenerator) : self
    {
        if ($this->hasHandlerInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabHandlerInterfaceGenerator is already set.');
        }
        $this->NeighborhoodsPrefabHandlerInterfaceGenerator = $handlerInterfaceGenerator;

        return $this;
    }

    protected function getHandlerInterfaceGenerator() : GeneratorInterface
    {
        if (!$this->hasHandlerInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabHandlerInterfaceGenerator is not set.');
        }

        return $this->NeighborhoodsPrefabHandlerInterfaceGenerator;
    }

    protected function hasHandlerInterfaceGenerator() : bool
    {
        return isset($this->NeighborhoodsPrefabHandlerInterfaceGenerator);
    }

    protected function unsetHandlerInterfaceGenerator() : self
    {
        if (!$this->hasHandlerInterfaceGenerator()) {
            throw new \LogicException('NeighborhoodsPrefabHandlerInterfaceGenerator is not set.');
        }
        unset($this->NeighborhoodsPrefabHandlerInterfaceGenerator);

        return $this;
    }
}
