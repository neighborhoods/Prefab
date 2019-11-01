<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\HttpSkeleton;


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

interface GeneratorInterface
{
    public function generate() : GeneratorInterface;
    public function setProjectName(string $projectName) : GeneratorInterface;
    public function setSrcDirectory(string $sourceDirectory) : GeneratorInterface;
    public function setTargetDirectory(string $targetDirectory) : GeneratorInterface;
    public function setFileSystem(Filesystem $fileSystem) : GeneratorInterface;
    public function setFinder(Finder $finder) : GeneratorInterface;
    public function setHttpSourceDirectory(string $httpSourceDirectory) : GeneratorInterface;
    public function setVendorName(string $vendorName) : GeneratorInterface;
}
