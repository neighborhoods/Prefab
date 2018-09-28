<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\StringReplacer;

use Neighborhoods\Prefab\StringReplacerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabStringReplacer;

    public function setStringReplacer(StringReplacerInterface $stringReplacer) : self
    {
        if ($this->hasStringReplacer()) {
            throw new \LogicException('NeighborhoodsPrefabStringReplacer is already set.');
        }
        $this->NeighborhoodsPrefabStringReplacer = $stringReplacer;

        return $this;
    }

    protected function getStringReplacer() : StringReplacerInterface
    {
        if (!$this->hasStringReplacer()) {
            throw new \LogicException('NeighborhoodsPrefabStringReplacer is not set.');
        }

        return $this->NeighborhoodsPrefabStringReplacer;
    }

    protected function hasStringReplacer() : bool
    {
        return isset($this->NeighborhoodsPrefabStringReplacer);
    }

    protected function unsetStringReplacer() : self
    {
        if (!$this->hasStringReplacer()) {
            throw new \LogicException('NeighborhoodsPrefabStringReplacer is not set.');
        }
        unset($this->NeighborhoodsPrefabStringReplacer);

        return $this;
    }
}
