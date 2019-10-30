<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\Decorator\Map\Factory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\Decorator\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory;

    public function setDoctrineDBALConnectionDecoratorMapFactory(
        FactoryInterface $doctrineDBALConnectionDecoratorMapFactory
    ): self {
        if ($this->hasDoctrineDBALConnectionDecoratorMapFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory = $doctrineDBALConnectionDecoratorMapFactory;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorMapFactory(): FactoryInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorMapFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory;
    }

    protected function hasDoctrineDBALConnectionDecoratorMapFactory(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory);
    }

    protected function unsetDoctrineDBALConnectionDecoratorMapFactory(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorMapFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMapFactory);

        return $this;
    }
}
