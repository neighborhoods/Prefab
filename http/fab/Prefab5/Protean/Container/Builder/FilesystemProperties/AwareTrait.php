<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder\FilesystemProperties;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder\FilesystemPropertiesInterface;

trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties;

    public function setProteanContainerBuilderFilesystemProperties(FilesystemPropertiesInterface $proteanContainerBuilderFilesystemProperties): self
    {
        if ($this->hasProteanContainerBuilderFilesystemProperties()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties = $proteanContainerBuilderFilesystemProperties;

        return $this;
    }

    protected function getProteanContainerBuilderFilesystemProperties(): FilesystemPropertiesInterface
    {
        if (!$this->hasProteanContainerBuilderFilesystemProperties()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties;
    }

    protected function hasProteanContainerBuilderFilesystemProperties(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties);
    }

    protected function unsetProteanContainerBuilderFilesystemProperties(): self
    {
        if (!$this->hasProteanContainerBuilderFilesystemProperties()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties);

        return $this;
    }
}
