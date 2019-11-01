<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\PDO\Builder;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\PDO\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilder;

    public function setPDOBuilder(BuilderInterface $pDOBuilder): self
    {
        if ($this->hasPDOBuilder()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilder is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilder = $pDOBuilder;

        return $this;
    }

    protected function getPDOBuilder(): BuilderInterface
    {
        if (!$this->hasPDOBuilder()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilder is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilder;
    }

    protected function hasPDOBuilder(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilder);
    }

    protected function unsetPDOBuilder(): self
    {
        if (!$this->hasPDOBuilder()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilder is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductPDOBuilder);

        return $this;
    }
}
