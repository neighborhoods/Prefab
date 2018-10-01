<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Doctrine\DBAL\Connection\Decorator\Map\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Doctrine\DBAL\Connection\Decorator\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory;

    public function setDoctrineDBALConnectionDecoratorMapFactory(
        FactoryInterface $doctrineDBALConnectionDecoratorMapFactory
    ): self {
        if ($this->hasDoctrineDBALConnectionDecoratorMapFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory = $doctrineDBALConnectionDecoratorMapFactory;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorMapFactory(): FactoryInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorMapFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory;
    }

    protected function hasDoctrineDBALConnectionDecoratorMapFactory(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory);
    }

    protected function unsetDoctrineDBALConnectionDecoratorMapFactory(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorMapFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory);

        return $this;
    }
}
