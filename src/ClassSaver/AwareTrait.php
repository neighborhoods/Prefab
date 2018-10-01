<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ClassSaver;

use Neighborhoods\Prefab\ClassSaverInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabClassSaver;

    public function setClassSaver(ClassSaverInterface $classSaver): self
    {
        if ($this->hasClassSaver()) {
            throw new \LogicException('NeighborhoodsPrefabClassSaver is already set.');
        }
        $this->NeighborhoodsPrefabClassSaver = $classSaver;

        return $this;
    }

    protected function getClassSaver(): ClassSaverInterface
    {
        if (!$this->hasClassSaver()) {
            throw new \LogicException('NeighborhoodsPrefabClassSaver is not set.');
        }

        return $this->NeighborhoodsPrefabClassSaver;
    }

    protected function hasClassSaver(): bool
    {
        return isset($this->NeighborhoodsPrefabClassSaver);
    }

    protected function unsetClassSaver(): self
    {
        if (!$this->hasClassSaver()) {
            throw new \LogicException('NeighborhoodsPrefabClassSaver is not set.');
        }
        unset($this->NeighborhoodsPrefabClassSaver);

        return $this;
    }
}
