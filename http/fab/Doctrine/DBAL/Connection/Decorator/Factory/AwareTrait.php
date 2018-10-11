<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\Decorator\Factory;

use Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\Decorator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorFactory;

    public function setDoctrineDBALConnectionDecoratorFactory(FactoryInterface $doctrineDBALConnectionDecoratorFactory
    ): self {
        if ($this->hasDoctrineDBALConnectionDecoratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorFactory = $doctrineDBALConnectionDecoratorFactory;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorFactory;
    }

    protected function hasDoctrineDBALConnectionDecoratorFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorFactory);
    }

    protected function unsetDoctrineDBALConnectionDecoratorFactory(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41DoctrineDBALConnectionDecoratorFactory);

        return $this;
    }
}
