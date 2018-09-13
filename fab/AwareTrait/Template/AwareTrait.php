<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AwareTrait\Template;

use Neighborhoods\Prefab\AwareTrait\Template;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabAwareTraitTemplate;

    public function setAwareTraitTemplate(Template $awareTraitTemplate) : self
    {
        if ($this->hasAwareTraitTemplate()) {
            throw new \LogicException('NeighborhoodsPrefabAwareTraitTemplate is already set.');
        }
        $this->NeighborhoodsPrefabAwareTraitTemplate = $awareTraitTemplate;

        return $this;
    }

    protected function getAwareTraitTemplate() : Template
    {
        if (!$this->hasAwareTraitTemplate()) {
            throw new \LogicException('NeighborhoodsPrefabAwareTraitTemplate is not set.');
        }

        return $this->NeighborhoodsPrefabAwareTraitTemplate;
    }

    protected function hasAwareTraitTemplate() : bool
    {
        return isset($this->NeighborhoodsPrefabAwareTraitTemplate);
    }

    protected function unsetAwareTraitTemplate() : self
    {
        if (!$this->hasAwareTraitTemplate()) {
            throw new \LogicException('NeighborhoodsPrefabAwareTraitTemplate is not set.');
        }
        unset($this->NeighborhoodsPrefabAwareTraitTemplate);

        return $this;
    }
}
