<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Factory\Template;

use Neighborhoods\Prefab\Factory\Template;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabFactoryTemplate;

    public function setFactoryTemplate(Template $FactoryTemplate) : self
    {
        if ($this->hasFactoryTemplate()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryTemplate is already set.');
        }
        $this->NeighborhoodsPrefabFactoryTemplate = $FactoryTemplate;

        return $this;
    }

    protected function getFactoryTemplate() : Template
    {
        if (!$this->hasFactoryTemplate()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryTemplate is not set.');
        }

        return $this->NeighborhoodsPrefabFactoryTemplate;
    }

    protected function hasFactoryTemplate() : bool
    {
        return isset($this->NeighborhoodsPrefabFactoryTemplate);
    }

    protected function unsetFactoryTemplate() : self
    {
        if (!$this->hasFactoryTemplate()) {
            throw new \LogicException('NeighborhoodsPrefabFactoryTemplate is not set.');
        }
        unset($this->NeighborhoodsPrefabFactoryTemplate);

        return $this;
    }
}
