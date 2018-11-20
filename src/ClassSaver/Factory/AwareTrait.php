<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ClassSaver\Factory;

use Neighborhoods\Prefab\ClassSaver\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabClassSaverFactory;

    public function setClassSaverFactory(FactoryInterface $classSaverFactory): self
    {
        if ($this->hasClassSaverFactory()) {
            throw new \LogicException('NeighborhoodsPrefabClassSaverFactory is already set.');
        }
        $this->NeighborhoodsPrefabClassSaverFactory = $classSaverFactory;

        return $this;
    }

    protected function getClassSaverFactory(): FactoryInterface
    {
        if (!$this->hasClassSaverFactory()) {
            throw new \LogicException('NeighborhoodsPrefabClassSaverFactory is not set.');
        }

        return $this->NeighborhoodsPrefabClassSaverFactory;
    }

    protected function hasClassSaverFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabClassSaverFactory);
    }

    protected function unsetClassSaverFactory(): self
    {
        if (!$this->hasClassSaverFactory()) {
            throw new \LogicException('NeighborhoodsPrefabClassSaverFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabClassSaverFactory);

        return $this;
    }
}
