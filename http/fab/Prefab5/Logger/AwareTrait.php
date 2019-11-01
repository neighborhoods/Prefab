<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Logger;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\LoggerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5Logger;

    public function setPrefab5Logger(LoggerInterface $prefab5Logger) : self
    {
        if ($this->hasPrefab5Logger()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5Logger is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5Logger = $prefab5Logger;

        return $this;
    }

    protected function getPrefab5Logger() : LoggerInterface
    {
        if (!$this->hasPrefab5Logger()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5Logger is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5Logger;
    }

    protected function hasPrefab5Logger() : bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5Logger);
    }

    protected function unsetPrefab5Logger() : self
    {
        if (!$this->hasPrefab5Logger()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5Logger is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPrefab5Logger);

        return $this;
    }
}
