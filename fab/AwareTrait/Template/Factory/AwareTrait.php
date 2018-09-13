<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AwareTrait\Template\Factory;

use Neighborhoods\Prefab\AwareTrait\Template\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabAwareTraitTemplateFactory;

    public function setAwareTraitTemplateFactory(FactoryInterface $awareTraitTemplateFactory) : self
    {
        if ($this->hasAwareTraitTemplateFactory()) {
            throw new \LogicException('NeighborhoodsPrefabAwareTraitTemplateFactory is already set.');
        }
        $this->NeighborhoodsPrefabAwareTraitTemplateFactory = $awareTraitTemplateFactory;

        return $this;
    }

    protected function getAwareTraitTemplateFactory() : FactoryInterface
    {
        if (!$this->hasAwareTraitTemplateFactory()) {
            throw new \LogicException('NeighborhoodsPrefabAwareTraitTemplateFactory is not set.');
        }

        return $this->NeighborhoodsPrefabAwareTraitTemplateFactory;
    }

    protected function hasAwareTraitTemplateFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabAwareTraitTemplateFactory);
    }

    protected function unsetAwareTraitTemplateFactory() : self
    {
        if (!$this->hasAwareTraitTemplateFactory()) {
            throw new \LogicException('NeighborhoodsPrefabAwareTraitTemplateFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabAwareTraitTemplateFactory);

        return $this;
    }
}
