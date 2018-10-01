<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Doctrine\DBAL\Connection\Decorator\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Doctrine\DBAL\Connection\Decorator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory;

    public function setDoctrineDBALConnectionDecoratorFactory(FactoryInterface $doctrineDBALConnectionDecoratorFactory
    ): self {
        if ($this->hasDoctrineDBALConnectionDecoratorFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory = $doctrineDBALConnectionDecoratorFactory;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory;
    }

    protected function hasDoctrineDBALConnectionDecoratorFactory(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory);
    }

    protected function unsetDoctrineDBALConnectionDecoratorFactory(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory);

        return $this;
    }
}
