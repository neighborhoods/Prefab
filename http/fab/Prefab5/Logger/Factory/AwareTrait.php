<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Logger\Factory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Logger\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory;

    public function setPrefab5LoggerFactory(FactoryInterface $prefab5LoggerFactory) : self
    {
        if ($this->hasPrefab5LoggerFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory = $prefab5LoggerFactory;

        return $this;
    }

    protected function getPrefab5LoggerFactory() : FactoryInterface
    {
        if (!$this->hasPrefab5LoggerFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory;
    }

    protected function hasPrefab5LoggerFactory() : bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory);
    }

    protected function unsetPrefab5LoggerFactory() : self
    {
        if (!$this->hasPrefab5LoggerFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5LoggerFactory);

        return $this;
    }
}
