<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\Decorator\Factory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\Decorator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory;

    public function setDoctrineDBALConnectionDecoratorFactory(FactoryInterface $doctrineDBALConnectionDecoratorFactory
    ): self {
        if ($this->hasDoctrineDBALConnectionDecoratorFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory = $doctrineDBALConnectionDecoratorFactory;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory;
    }

    protected function hasDoctrineDBALConnectionDecoratorFactory(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory);
    }

    protected function unsetDoctrineDBALConnectionDecoratorFactory(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorFactory);

        return $this;
    }
}
