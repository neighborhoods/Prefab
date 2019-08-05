<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

use Symfony\Component\Filesystem\Filesystem;

interface BradFabricatorInterface
{
    public function fabricateSupportingActors() : BradFabricatorInterface;

    public function setProjectRoot(string $project_root) : BradFabricatorInterface;

    public function setProjectName($project_name) : BradFabricatorInterface;

    public function setFileSystem(Filesystem $file_system) : BradFabricatorInterface;

}
