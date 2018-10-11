<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\Decorator\Map;

use Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\Decorator\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMap;

    public function setDoctrineDBALConnectionDecoratorMap(MapInterface $doctrineDBALConnectionDecoratorMap): self
    {
        if ($this->hasDoctrineDBALConnectionDecoratorMap()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMap is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMap = $doctrineDBALConnectionDecoratorMap;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorMap(): MapInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorMap()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMap is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMap;
    }

    protected function hasDoctrineDBALConnectionDecoratorMap(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMap);
    }

    protected function unsetDoctrineDBALConnectionDecoratorMap(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorMap()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMap is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMap);

        return $this;
    }
}
