<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\Decorator\Map\Factory;

use Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\Decorator\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMapFactory;

    public function setDoctrineDBALConnectionDecoratorMapFactory(
        FactoryInterface $doctrineDBALConnectionDecoratorMapFactory
    ): self {
        if ($this->hasDoctrineDBALConnectionDecoratorMapFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMapFactory is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMapFactory = $doctrineDBALConnectionDecoratorMapFactory;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorMapFactory(): FactoryInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorMapFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMapFactory is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMapFactory;
    }

    protected function hasDoctrineDBALConnectionDecoratorMapFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMapFactory);
    }

    protected function unsetDoctrineDBALConnectionDecoratorMapFactory(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorMapFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMapFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorMapFactory);

        return $this;
    }
}
