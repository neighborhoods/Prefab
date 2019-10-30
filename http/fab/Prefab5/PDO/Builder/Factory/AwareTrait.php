<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\PDO\Builder\Factory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\PDO\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilderFactory;

    public function setPDOBuilderFactory(FactoryInterface $pDOBuilderFactory): self
    {
        if ($this->hasPDOBuilderFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilderFactory is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilderFactory = $pDOBuilderFactory;

        return $this;
    }

    protected function getPDOBuilderFactory(): FactoryInterface
    {
        if (!$this->hasPDOBuilderFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilderFactory is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilderFactory;
    }

    protected function hasPDOBuilderFactory(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilderFactory);
    }

    protected function unsetPDOBuilderFactory(): self
    {
        if (!$this->hasPDOBuilderFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilderFactory is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilderFactory);

        return $this;
    }
}
