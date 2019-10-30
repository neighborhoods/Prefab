<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

use Symfony\Component\Filesystem\Filesystem;

interface FabricatorInterface
{
    public function fabricateSupportingActors() : FabricatorInterface;

    public function setProjectRoot(string $project_root) : FabricatorInterface;

    public function setProjectName($project_name) : FabricatorInterface;

    public function setVendorName(string $vendor_name) : FabricatorInterface;

    public function setFileSystem(Filesystem $file_system) : FabricatorInterface;

}
