<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\FilesystemProperties;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\FilesystemPropertiesInterface;

trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductHTTPBuildableDirectoryMapFilesystemProperties;

    public function setHTTPBuildableDirectoryMapFilesystemProperties(FilesystemPropertiesInterface $proteanContainerBuilderFilesystemProperties): self
    {
        if ($this->hasHTTPBuildableDirectoryMapFilesystemProperties()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductHTTPBuildableDirectoryMapFilesystemProperties is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductHTTPBuildableDirectoryMapFilesystemProperties = $proteanContainerBuilderFilesystemProperties;

        return $this;
    }

    protected function getHTTPBuildableDirectoryMapFilesystemProperties(): FilesystemPropertiesInterface
    {
        if (!$this->hasHTTPBuildableDirectoryMapFilesystemProperties()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductHTTPBuildableDirectoryMapFilesystemProperties is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductHTTPBuildableDirectoryMapFilesystemProperties;
    }

    protected function hasHTTPBuildableDirectoryMapFilesystemProperties(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductHTTPBuildableDirectoryMapFilesystemProperties);
    }

    protected function unsetHTTPBuildableDirectoryMapFilesystemProperties(): self
    {
        if (!$this->hasHTTPBuildableDirectoryMapFilesystemProperties()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductHTTPBuildableDirectoryMapFilesystemProperties is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductHTTPBuildableDirectoryMapFilesystemProperties);

        return $this;
    }
}
