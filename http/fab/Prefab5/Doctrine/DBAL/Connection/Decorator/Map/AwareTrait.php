<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\Decorator\Map;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\Decorator\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap;

    public function setDoctrineDBALConnectionDecoratorMap(MapInterface $doctrineDBALConnectionDecoratorMap): self
    {
        if ($this->hasDoctrineDBALConnectionDecoratorMap()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap = $doctrineDBALConnectionDecoratorMap;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorMap(): MapInterface
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorMap()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap;
    }

    protected function hasDoctrineDBALConnectionDecoratorMap(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap);
    }

    protected function unsetDoctrineDBALConnectionDecoratorMap(): self
    {
        if (!$this->hasDoctrineDBALConnectionDecoratorMap()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductDoctrineDBALConnectionDecoratorMap);

        return $this;
    }
}
