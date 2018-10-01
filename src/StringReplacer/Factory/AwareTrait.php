<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\StringReplacer\Factory;

use Neighborhoods\Prefab\StringReplacer\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabStringReplacerFactory;

    public function setStringReplacerFactory(FactoryInterface $stringReplacerFactory) : self
    {
        if ($this->hasStringReplacerFactory()) {
            throw new \LogicException('NeighborhoodsPrefabStringReplacerFactory is already set.');
        }
        $this->NeighborhoodsPrefabStringReplacerFactory = $stringReplacerFactory;

        return $this;
    }

    protected function getStringReplacerFactory() : FactoryInterface
    {
        if (!$this->hasStringReplacerFactory()) {
            throw new \LogicException('NeighborhoodsPrefabStringReplacerFactory is not set.');
        }

        return $this->NeighborhoodsPrefabStringReplacerFactory;
    }

    protected function hasStringReplacerFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabStringReplacerFactory);
    }

    protected function unsetStringReplacerFactory() : self
    {
        if (!$this->hasStringReplacerFactory()) {
            throw new \LogicException('NeighborhoodsPrefabStringReplacerFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabStringReplacerFactory);

        return $this;
    }
}
