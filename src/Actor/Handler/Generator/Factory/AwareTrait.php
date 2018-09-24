<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Handler\Generator\Factory;

use Neighborhoods\Prefab\Actor\Handler\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabHandlerGeneratorFactory;

    public function setHandlerGeneratorFactory(FactoryInterface $handlerGeneratorFactory) : self
    {
        if ($this->hasHandlerGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabHandlerGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabHandlerGeneratorFactory = $handlerGeneratorFactory;

        return $this;
    }

    protected function getHandlerGeneratorFactory() : FactoryInterface
    {
        if (!$this->hasHandlerGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabHandlerGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabHandlerGeneratorFactory;
    }

    protected function hasHandlerGeneratorFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabHandlerGeneratorFactory);
    }

    protected function unsetHandlerGeneratorFactory() : self
    {
        if (!$this->hasHandlerGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabHandlerGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabHandlerGeneratorFactory);

        return $this;
    }
}
