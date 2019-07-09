<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

use Neighborhoods\Bradfab\Bradfab;
use Symfony\Component\Filesystem\Filesystem;
use Neighborhoods\Bradfab\Protean\Container\Builder;

class BradFabricator implements BradFabricatorInterface
{
    protected $project_name;
    protected $project_root;
    protected $file_system;

    public function fabricateSupportingActors() : BradFabricatorInterface
    {
        $filesystem = $this->getFileSystem();
        $filesystem->mkdir([__DIR__ . '/../bradfab/', __DIR__ . '/../fabricatedFiles/']);

        // Where the Bradfab fabrication files were saved
        putenv('BRADFAB_TARGET_APPLICATION_SOURCE_PATH=' . realpath(__DIR__ . '/../bradfab'));
        // Where to put the supporting actors
        putenv('BRADFAB_TARGET_APPLICATION_FABRICATION_PATH=' . realpath(__DIR__ . '/../fabricatedFiles'));
        // Where to find the templates to generate the supporting actors
        putenv('BRADFAB_FABRICATOR_TEMPLATE_ACTOR_DIRECTORY_PATH='  . realpath(__DIR__ . '/Template/Prefab5/Actor'));
        // Namespace of the generated files
        putenv('BRADFAB_TARGET_APPLICATION_NAMESPACE=Neighborhoods\\'. $this->getProjectName() . '\\');

        $proteanContainerBuilder = (new Builder())->setApplicationRootDirectoryPath(realpath(__DIR__ . '/../../bradfab/'));

        $bradfab = (new Bradfab())->setProteanContainerBuilder($proteanContainerBuilder);
        $bradfab->run();

        $filesystem->mirror(realpath(__DIR__ . '/../fabricatedFiles'), realpath($this->getProjectRoot() . '/fab'));

        $filesystem->remove(realpath(__DIR__ . '/../fabricatedFiles/'));
        $filesystem->remove(realpath(__DIR__ . '/../bradfab/'));

        return $this;
    }

    protected function getProjectRoot() : string
    {
        if ($this->project_root === null) {
            throw new \LogicException('BradFabricator projectRoot has not been set.');
        }
        return $this->project_root;
    }

    public function setProjectRoot(string $project_root) : BradFabricatorInterface
    {
        if ($this->project_root !== null) {
            throw new \LogicException('BradFabricator projectRoot is already set.');
        }
        $this->project_root = $project_root;
        return $this;
    }


    protected function getFileSystem() : Filesystem
    {
        if ($this->file_system === null) {
            throw new \LogicException('BradFabricator file_system has not been set.');
        }

        return $this->file_system;
    }

    public function setFileSystem(Filesystem $file_system) : BradFabricatorInterface
    {
        if ($this->file_system !== null) {
            throw new \LogicException('BradFabricator file_system is already set.');
        }
        $this->file_system = $file_system;
        return $this;
    }

    protected function getProjectName()
    {
        if ($this->project_name === null) {
            throw new \LogicException('BradFabricator project_name has not been set.');
        }
        return $this->project_name;
    }

    public function setProjectName($project_name) : BradFabricatorInterface
    {
        if ($this->project_name !== null) {
            throw new \LogicException('BradFabricator project_name is already set.');
        }
        $this->project_name = $project_name;
        return $this;
    }

}
