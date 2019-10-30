<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\Decorator;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\DecoratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator;

    public function setDoctrineDBALConnectionDecorator(DecoratorInterface $doctrineDBALConnectionDecorator): self
    {
        if ($this->hasDoctrineDBALConnectionDecorator()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator = $doctrineDBALConnectionDecorator;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecorator(): DecoratorInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecorator()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator;
    }

    protected function hasDoctrineDBALConnectionDecorator(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator);
    }

    protected function unsetDoctrineDBALConnectionDecorator(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecorator()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecorator);

        return $this;
    }
}
