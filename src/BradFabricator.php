<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

use Neighborhoods\Buphalo\Buphalo;
use Symfony\Component\Filesystem\Filesystem;
use Neighborhoods\Buphalo\Protean\Container\Builder;

class BradFabricator implements BradFabricatorInterface
{
    protected $project_name;
    protected $project_root;
    protected $file_system;

    public function fabricateSupportingActors() : BradFabricatorInterface
    {
        $filesystem = $this->getFileSystem();
        $filesystem->mkdir([__DIR__ . '/../bradfab/', __DIR__ . '/../fabricatedFiles/']);

        // Where the Buphalo fabrication files are located
        putenv('BUPHALO_TARGET_APPLICATION_SOURCE_PATH=' . realpath(__DIR__ . '/../bradfab'));
        // Where to put the generated supporting actors
        putenv('BUPHALO_TARGET_APPLICATION_FABRICATION_PATH=' . realpath(__DIR__ . '/../fabricatedFiles'));
        // Where the supporting actor templates are located
        putenv('BUPHALO_FABRICATOR_TEMPLATE_TREE_DIRECTORY_PATH='  . realpath(__DIR__ . '/BuphaloTemplates/Prefab5'));
        // Namespace of the generated files
        putenv('BUPHALO_TARGET_APPLICATION_NAMESPACE=Neighborhoods\\'. $this->getProjectName() . '\\');

        putenv('Neighborhoods_Buphalo_TemplateTree_Map_Builder_FactoryInterface__TemplateTreeDirectoryPaths='. realpath(__DIR__ . '/BuphaloTemplates/Prefab5'));
        putenv('Neighborhoods_Buphalo_TargetApplication_BuilderInterface__NamespacePrefix=Neighborhoods\\Buphalo\\');
        putenv('Neighborhoods_Buphalo_TargetApplication_BuilderInterface__SourceDirectoryPath='. realpath(__DIR__ . '/../../../neighborhoods/buphalo/src'));
        putenv('Neighborhoods_Buphalo_TargetApplication_BuilderInterface__FabricationDirectoryPath='. realpath(__DIR__ . '/../../../neighborhoods/buphalo/fab'));


        $proteanContainerBuilder = (new Builder())->setApplicationRootDirectoryPath(realpath(__DIR__ . '/../../buphalo/'));

        $bradfab = (new Buphalo())->setProteanContainerBuilder($proteanContainerBuilder);
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
