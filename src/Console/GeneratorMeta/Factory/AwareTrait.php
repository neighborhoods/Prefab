<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console\GeneratorMeta\Factory;

use Neighborhoods\Prefab\Console\GeneratorMeta\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabConsoleGeneratorMetaFactory;

    public function setConsoleGeneratorMetaFactory(FactoryInterface $consoleGeneratorMetaFactory): self
    {
        if ($this->hasConsoleGeneratorMetaFactory()) {
            throw new \LogicException('NeighborhoodsPrefabConsoleGeneratorMetaFactory is already set.');
        }
        $this->NeighborhoodsPrefabConsoleGeneratorMetaFactory = $consoleGeneratorMetaFactory;

        return $this;
    }

    protected function getConsoleGeneratorMetaFactory(): FactoryInterface
    {
        if (!$this->hasConsoleGeneratorMetaFactory()) {
            throw new \LogicException('NeighborhoodsPrefabConsoleGeneratorMetaFactory is not set.');
        }

        return $this->NeighborhoodsPrefabConsoleGeneratorMetaFactory;
    }

    protected function hasConsoleGeneratorMetaFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabConsoleGeneratorMetaFactory);
    }

    protected function unsetConsoleGeneratorMetaFactory(): self
    {
        if (!$this->hasConsoleGeneratorMetaFactory()) {
            throw new \LogicException('NeighborhoodsPrefabConsoleGeneratorMetaFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabConsoleGeneratorMetaFactory);

        return $this;
    }
}
