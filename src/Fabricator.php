<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

use Neighborhoods\Buphalo\V1\AnnotationProcessorInterface;
use Neighborhoods\Buphalo\V1\Buphalo;
use Symfony\Component\Filesystem\Filesystem;
use Neighborhoods\Buphalo\V1\Protean\Container\Builder;

class Fabricator implements FabricatorInterface
{
    protected $vendor_name;
    protected $project_name;
    protected $project_root;
    protected $file_system;

    public function fabricateSupportingActors() : FabricatorInterface
    {
        $filesystem = $this->getFileSystem();
        $filesystem->mkdir([__DIR__ . '/../BuphaloFabFiles/', __DIR__ . '/../fabricatedFiles/']);

        // Where the supporting actor templates are located
        putenv('Neighborhoods_Buphalo_V1_TemplateTree_Map_Builder_FactoryInterface__TemplateTreeDirectoryPaths='. realpath(__DIR__ . '/../BuphaloTemplates/Prefab5'));
        // Namespace of the generated files
        putenv('Neighborhoods_Buphalo_V1_TargetApplication_BuilderInterface__NamespacePrefix='. $this->getVendorName() .'\\'. $this->getProjectName() . '\\');
        // Where the Buphalo fabrication files are located
        putenv('Neighborhoods_Buphalo_V1_TargetApplication_BuilderInterface__SourceDirectoryPath='. realpath(__DIR__ . '/../BuphaloFabFiles'));
        // Directory to save the generated supporting actors
        putenv('Neighborhoods_Buphalo_V1_TargetApplication_BuilderInterface__FabricationDirectoryPath='. realpath(__DIR__ . '/../fabricatedFiles'));

        $proteanContainerBuilder = (new Builder())->setApplicationRootDirectoryPath(realpath(__DIR__ . '/../../buphalo/'));

        $buphalo = (new Buphalo())->setProteanContainerBuilder($proteanContainerBuilder);
        $buphalo->run();

        $filesystem->mirror(realpath(__DIR__ . '/../fabricatedFiles'), realpath($this->getProjectRoot() . '/fab'));

        $filesystem->remove(realpath(__DIR__ . '/../fabricatedFiles/'));
        $filesystem->remove(realpath(__DIR__ . '/../BuphaloFabFiles/'));

        return $this;
    }

    protected function getProjectRoot() : string
    {
        if ($this->project_root === null) {
            throw new \LogicException('BradFabricator projectRoot has not been set.');
        }
        return $this->project_root;
    }

    public function setProjectRoot(string $project_root) : FabricatorInterface
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

    public function setFileSystem(Filesystem $file_system) : FabricatorInterface
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

    public function setProjectName($project_name) : FabricatorInterface
    {
        if ($this->project_name !== null) {
            throw new \LogicException('BradFabricator project_name is already set.');
        }
        $this->project_name = $project_name;
        return $this;
    }

    protected function getVendorName() : string
    {
        if ($this->vendor_name === null) {
            throw new \LogicException('Fabricator vendor_name has not been set.');
        }
        return $this->vendor_name;
    }

    public function setVendorName(string $vendor_name) : FabricatorInterface
    {
        if ($this->vendor_name !== null) {
            throw new \LogicException('Fabricator vendor_name is already set.');
        }
        $this->vendor_name = $vendor_name;
        return $this;
    }
}
