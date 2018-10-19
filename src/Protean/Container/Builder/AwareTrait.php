<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Protean\Container\Builder;

use Neighborhoods\Prefab\Protean\Container\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabProteanContainerBuilder;

    public function setProteanContainerBuilder(BuilderInterface $proteanContainerBuilder): self
    {
        if ($this->hasProteanContainerBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabProteanContainerBuilder is already set.');
        }
        $this->NeighborhoodsPrefabProteanContainerBuilder = $proteanContainerBuilder;

        return $this;
    }

    protected function getProteanContainerBuilder(): BuilderInterface
    {
        if (!$this->hasProteanContainerBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabProteanContainerBuilder is not set.');
        }

        return $this->NeighborhoodsPrefabProteanContainerBuilder;
    }

    protected function hasProteanContainerBuilder(): bool
    {
        return isset($this->NeighborhoodsPrefabProteanContainerBuilder);
    }

    protected function unsetProteanContainerBuilder(): self
    {
        if (!$this->hasProteanContainerBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabProteanContainerBuilder is not set.');
        }
        unset($this->NeighborhoodsPrefabProteanContainerBuilder);

        return $this;
    }
}
