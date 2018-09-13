<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FactoryInterface\Template\FactoryInterface;

use Neighborhoods\Prefab\FactoryInterface\Template\FactoryInterface;

/** @codeCoverageIgnore */
trait Factory
{
    protected $NeighborhoodsPrefabFactoryTemplateFactoryInterface;

    public function setFactoryTemplateFactoryInterface(FactoryInterface $FactoryTemplateFactoryInterface ) : self
    {
        if ($this->hasFactoryTemplateFactoryInterface()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryTemplateFactoryInterface is already set.');
        }
        $this->NeighborhoodsPrefabFactoryTemplateFactoryInterface = $FactoryTemplateFactoryInterface;

        return $this;
    }

    protected function getFactoryTemplateFactoryInterface() : FactoryInterface
    {
        if (!$this->hasFactoryTemplateFactoryInterface()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryTemplateFactoryInterface is not set.');
        }

        return $this->NeighborhoodsPrefabFactoryTemplateFactoryInterface;
    }

    protected function hasFactoryTemplateFactoryInterface() : bool
    {
        return isset($this->NeighborhoodsPrefabFactoryTemplateFactoryInterface );
    }

    protected function unsetFactoryTemplateFactoryInterface() : self
    {
        if (!$this->hasFactoryTemplateFactoryInterface()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryTemplateFactoryInterface is not set.');
        }
        unset($this->NeighborhoodsPrefabFactoryTemplateFactoryInterface );

        return $this;
    }
}
