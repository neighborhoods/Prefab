<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\PDO\Builder;

use Neighborhoods\PrefabExamplesFunction41\PDO\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41PDOBuilder;

    public function setPDOBuilder(BuilderInterface $pDOBuilder): self
    {
        if ($this->hasPDOBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41PDOBuilder is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41PDOBuilder = $pDOBuilder;

        return $this;
    }

    protected function getPDOBuilder(): BuilderInterface
    {
        if (!$this->hasPDOBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41PDOBuilder is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41PDOBuilder;
    }

    protected function hasPDOBuilder(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41PDOBuilder);
    }

    protected function unsetPDOBuilder(): self
    {
        if (!$this->hasPDOBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41PDOBuilder is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41PDOBuilder);

        return $this;
    }
}
