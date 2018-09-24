<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\HandlerInterface\Generator\Factory;

use Neighborhoods\Prefab\Actor\HandlerInterface\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabHandlerInterfaceFactory;

    public function setHandlerInterfaceFactory(FactoryInterface $handlerInterfaceFactory) : self
    {
        if ($this->hasHandlerInterfaceFactory()) {
            throw new \LogicException('NeighborhoodsPrefabHandlerInterfaceFactory is already set.');
        }
        $this->NeighborhoodsPrefabHandlerInterfaceFactory = $handlerInterfaceFactory;

        return $this;
    }

    protected function getHandlerInterfaceFactory() : FactoryInterface
    {
        if (!$this->hasHandlerInterfaceFactory()) {
            throw new \LogicException('NeighborhoodsPrefabHandlerInterfaceFactory is not set.');
        }

        return $this->NeighborhoodsPrefabHandlerInterfaceFactory;
    }

    protected function hasHandlerInterfaceFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabHandlerInterfaceFactory);
    }

    protected function unsetHandlerInterfaceFactory() : self
    {
        if (!$this->hasHandlerInterfaceFactory()) {
            throw new \LogicException('NeighborhoodsPrefabHandlerInterfaceFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabHandlerInterfaceFactory);

        return $this;
    }
}
