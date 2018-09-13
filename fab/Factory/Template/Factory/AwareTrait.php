<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Factory\Template\Factory;

use Neighborhoods\Prefab\Factory\Template\FactoryInterface;

/** @codeCoverageIgnore */
trait Factory
{
    protected $NeighborhoodsPrefabFactoryTemplateFactory;

    public function setFactoryTemplateFactory(FactoryInterface $FactoryTemplateFactory) : self
    {
        if ($this->hasFactoryTemplateFactory()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryTemplateFactory is already set.');
        }
        $this->NeighborhoodsPrefabFactoryTemplateFactory = $FactoryTemplateFactory;

        return $this;
    }

    protected function getFactoryTemplateFactory() : FactoryInterface
    {
        if (!$this->hasFactoryTemplateFactory()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryTemplateFactory is not set.');
        }

        return $this->NeighborhoodsPrefabFactoryTemplateFactory;
    }

    protected function hasFactoryTemplateFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabFactoryTemplateFactory);
    }

    protected function unsetFactoryTemplateFactory() : self
    {
        if (!$this->hasFactoryTemplateFactory()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryTemplateFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabFactoryTemplateFactory);

        return $this;
    }
}
