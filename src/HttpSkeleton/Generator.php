<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\HttpSkeleton;


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class Generator implements GeneratorInterface
{
    const VENDOR_NAME_PLACEHOLDER = 'ReplaceThisWithTheNameOfYourVendor';
    const PROJECT_NAME_PLACEHOLDER = 'ReplaceThisWithTheNameOfYourProduct';
    protected $projectName;
    protected $vendorName;
    protected $srcDirectory;
    protected $targetDirectory;
    protected $stagedDirectory;
    protected $httpSourceDirectory;
    protected $fileSystem;
    protected $finder;

    public function generate() : GeneratorInterface
    {
        $this->setStagedDirectory($this->getHttpSourceDirectory() . '/../StagedHttp');

        $options['override'] = true;

        if (!file_exists($this->getStagedDirectory())) {
            $this->getFileSystem()->mkdir($this->getStagedDirectory());
        }

        $this->getFileSystem()->mirror($this->getHttpSourceDirectory(), $this->getStagedDirectory(), null, $options);
        $this->setProjectNameInStagedHttpFiles();

        $httpDirs = $this->getFinder()->directories()->in($this->getStagedDirectory());

        /** @var SplFileInfo $dir */
        foreach ($httpDirs as $dir) {
            $dirName = $this->getTargetDirectory() . $dir->getFilename();
            if ($this->getFileSystem()->exists($dirName)) {
                $this->getFileSystem()->remove($dirName);
            }
        }

        $this->getFileSystem()->mirror($this->getStagedDirectory(), $this->getTargetDirectory(), null, $options);
        $this->getFileSystem()->remove($this->getStagedDirectory());

        return $this;
    }

    protected function setProjectNameInStagedHttpFiles() : GeneratorInterface
    {
        $finder = new Finder();
        $finder->files()->in($this->getStagedDirectory());

        foreach ($finder as $file) {
            $contents = $file->getContents();
            $modifiedContents = str_replace(self::VENDOR_NAME_PLACEHOLDER, $this->getVendorName(), $contents);
            $modifiedContents = str_replace(self::PROJECT_NAME_PLACEHOLDER, $this->getProjectName(), $modifiedContents);
            file_put_contents($file->getRealPath(), $modifiedContents);
        }

        return $this;
    }

    protected function getProjectName() : string
    {
        if ($this->projectName === null) {
            throw new \LogicException('Generator projectName has not been set.');
        }
        return $this->projectName;
    }

    public function setProjectName(string $projectName) : GeneratorInterface
    {
        if ($this->projectName !== null) {
            throw new \LogicException('Generator projectName is already set.');
        }
        $this->projectName = $projectName;
        return $this;
    }

    protected function getSrcDirectory() : string
    {
        if ($this->srcDirectory === null) {
            throw new \LogicException('Generator sourceDirectory has not been set.');
        }
        return $this->srcDirectory;
    }

    public function setSrcDirectory(string $srcDirectory) : GeneratorInterface
    {
        if ($this->srcDirectory !== null) {
            throw new \LogicException('Generator sourceDirectory is already set.');
        }
        $this->srcDirectory = $srcDirectory;
        return $this;
    }

    protected function getTargetDirectory() : string
    {
        if ($this->targetDirectory === null) {
            throw new \LogicException('Generator targetDirectory has not been set.');
        }
        return $this->targetDirectory;
    }

    public function setTargetDirectory(string $targetDirectory) : GeneratorInterface
    {
        if ($this->targetDirectory !== null) {
            throw new \LogicException('Generator targetDirectory is already set.');
        }
        $this->targetDirectory = $targetDirectory;
        return $this;
    }

    protected function getStagedDirectory() : string
    {
        if ($this->stagedDirectory === null) {
            throw new \LogicException('Generator stagedDir has not been set.');
        }
        return $this->stagedDirectory;
    }

    protected function setStagedDirectory(string $stagedDirectory) : GeneratorInterface
    {
        if ($this->stagedDirectory !== null) {
            throw new \LogicException('Generator stagedDir is already set.');
        }
        $this->stagedDirectory = $stagedDirectory;
        return $this;
    }

    // What should we do about vendor classes that don't implement interfaces
    protected function getFileSystem() : Filesystem
    {
        if ($this->fileSystem === null) {
            throw new \LogicException('Generator fileSystem has not been set.');
        }
        return $this->fileSystem;
    }

    public function setFileSystem(Filesystem $fileSystem) : GeneratorInterface
    {
        if ($this->fileSystem !== null) {
            throw new \LogicException('Generator fileSystem is already set.');
        }
        $this->fileSystem = $fileSystem;
        return $this;
    }

    protected function getFinder() : Finder
    {
        if ($this->finder === null) {
            throw new \LogicException('Generator finder has not been set.');
        }
        return $this->finder;
    }

    public function setFinder(Finder $finder) : GeneratorInterface
    {
        if ($this->finder !== null) {
            throw new \LogicException('Generator finder is already set.');
        }
        $this->finder = $finder;
        return $this;
    }

    protected function getHttpSourceDirectory() : string
    {
        if ($this->httpSourceDirectory === null) {
            throw new \LogicException('Generator httpSourceDirectory has not been set.');
        }
        return $this->httpSourceDirectory;
    }

    public function setHttpSourceDirectory(string $httpSourceDirectory) : GeneratorInterface
    {
        if ($this->httpSourceDirectory !== null) {
            throw new \LogicException('Generator httpSourceDirectory is already set.');
        }
        $this->httpSourceDirectory = $httpSourceDirectory;
        return $this;
    }

    protected function getVendorName() : string
    {
        if ($this->vendorName === null) {
            throw new \LogicException('Generator vendorName has not been set.');
        }
        return $this->vendorName;
    }

    public function setVendorName(string $vendorName) : GeneratorInterface
    {
        if ($this->vendorName !== null) {
            throw new \LogicException('Generator vendorName is already set.');
        }
        $this->vendorName = $vendorName;
        return $this;
    }
}

