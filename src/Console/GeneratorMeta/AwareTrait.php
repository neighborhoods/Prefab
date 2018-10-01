<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console\GeneratorMeta;

use Neighborhoods\Prefab\Console\GeneratorMetaInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabConsoleGeneratorMeta;

    public function setConsoleGeneratorMeta(GeneratorMetaInterface $consoleGeneratorMeta): self
    {
        if ($this->hasConsoleGeneratorMeta()) {
            throw new \LogicException('NeighborhoodsPrefabConsoleGeneratorMeta is already set.');
        }
        $this->NeighborhoodsPrefabConsoleGeneratorMeta = $consoleGeneratorMeta;

        return $this;
    }

    protected function getConsoleGeneratorMeta(): GeneratorMetaInterface
    {
        if (!$this->hasConsoleGeneratorMeta()) {
            throw new \LogicException('NeighborhoodsPrefabConsoleGeneratorMeta is not set.');
        }

        return $this->NeighborhoodsPrefabConsoleGeneratorMeta;
    }

    protected function hasConsoleGeneratorMeta(): bool
    {
        return isset($this->NeighborhoodsPrefabConsoleGeneratorMeta);
    }

    protected function unsetConsoleGeneratorMeta(): self
    {
        if (!$this->hasConsoleGeneratorMeta()) {
            throw new \LogicException('NeighborhoodsPrefabConsoleGeneratorMeta is not set.');
        }
        unset($this->NeighborhoodsPrefabConsoleGeneratorMeta);

        return $this;
    }
}
