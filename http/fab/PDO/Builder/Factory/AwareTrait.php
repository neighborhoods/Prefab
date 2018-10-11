<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\PDO\Builder\Factory;

use Neighborhoods\PrefabExamplesFunction41\PDO\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41PDOBuilderFactory;

    public function setPDOBuilderFactory(FactoryInterface $pDOBuilderFactory): self
    {
        if ($this->hasPDOBuilderFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41PDOBuilderFactory is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41PDOBuilderFactory = $pDOBuilderFactory;

        return $this;
    }

    protected function getPDOBuilderFactory(): FactoryInterface
    {
        if (!$this->hasPDOBuilderFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41PDOBuilderFactory is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41PDOBuilderFactory;
    }

    protected function hasPDOBuilderFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41PDOBuilderFactory);
    }

    protected function unsetPDOBuilderFactory(): self
    {
        if (!$this->hasPDOBuilderFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41PDOBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41PDOBuilderFactory);

        return $this;
    }
}
