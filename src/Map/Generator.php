<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Map;

use Neighborhoods\Prefab\Console\GeneratorInterface;
use Neighborhoods\Prefab\Console\GeneratorMetaInterface;
use Symfony\Component\Yaml\Yaml;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\InterfaceGenerator;
use Zend\Code\Reflection\ClassReflection;

class Generator implements GeneratorInterface
{
    /** @var GeneratorMetaInterface */
    protected $meta;

    public function getMeta(): GeneratorMetaInterface
    {
        if ($this->meta === null) {
            throw new \LogicException('Generator meta has not been set.');
        }
        return $this->meta;
    }

    public function setMeta(GeneratorMetaInterface $meta): GeneratorInterface
    {
        if ($this->meta !== null) {
            throw new \LogicException('Generator meta is already set.');
        }
        $this->meta = $meta;
        return $this;
    }

    public function generate(): GeneratorInterface
    {
        $meta = $this->getMeta();

        $mapTemplate = new ClassReflection(Template::class);
        $generator = ClassGenerator::fromReflection($mapTemplate);

        $generator->setName('Map');
        $generator->setNamespaceName($meta->getActorNamespace());
        $generator->setExtendedClass('\ArrayIterator');
        $generator->setImplementedInterfaces([$meta->getActorNamespace() . '\MapInterface']);
        $generator->addUse($meta->getActorNamespace() . '\MapInterface');

        $methods = $generator->getMethods();
        foreach ($methods as $method) {
            $returnType = $method->getReturnType();
            if ($returnType && strpos($returnType->generate(), 'REPLACE_DAO_NAMEInterface')) {
                $method->setReturnType($meta->getActorNamespace() . '\\' . $meta->getDaoName() . 'Interface');
            }
        }

        $file = new FileGenerator();
        $file->setClass($generator);

        $fileContent = $file->generate();
        $builtFile = $this->replaceEntityPlaceholders($fileContent, $daoName);

        $mapDirectory = 'fab/' . $this->version . DIRECTORY_SEPARATOR . ($parent ? $parent.DIRECTORY_SEPARATOR : '')
            . $daoName . DIRECTORY_SEPARATOR;
        if (!is_dir($mapDirectory)) {
            mkdir($mapDirectory,0777,true);
        }
        $this->mapDirectory = $mapDirectory;

        file_put_contents($mapDirectory . $generator->getName() . '.php', $builtFile);

        return $this;
    }

    public function generateMap(SplFileInfo $dao)
    {
        $parent = $dao->getRelativePath();
        $daoName = basename($dao->getFilename(),'.php');

        $mapTemplate = new ClassReflection(Template::class);
        $generator = ClassGenerator::fromReflection($mapTemplate);

        $generator->setName('Map');
        $generator->setNamespaceName($fullNamespace);
        $generator->setExtendedClass('\ArrayIterator');
        $generator->setImplementedInterfaces([$fullNamespace . '\MapInterface']);
        $generator->addUse($fullNamespace . 'Interface');

        $methods = $generator->getMethods();
        foreach ($methods as $method) {
            $returnType = $method->getReturnType();
            if ($returnType && strpos($returnType->generate(), 'REPLACE_DAO_NAMEInterface')) {
                $method->setReturnType($fullNamespace.'Interface');
            }
        }

        $file = new FileGenerator();
        $file->setClass($generator);

        $fileContent = $file->generate();
        $builtFile = $this->replaceEntityPlaceholders($fileContent, $daoName);

        $mapDirectory = 'fab/' . $this->version . DIRECTORY_SEPARATOR . ($parent ? $parent.DIRECTORY_SEPARATOR : '')
            . $daoName . DIRECTORY_SEPARATOR;
        if (!is_dir($mapDirectory)) {
            mkdir($mapDirectory,0777,true);
        }
        $this->mapDirectory = $mapDirectory;

        file_put_contents($mapDirectory . $generator->getName() . '.php', $builtFile);

        return $this;
    }

    protected function generateMapInterface(SplFileInfo $dao)
    {
        $parent = $dao->getRelativePath();
        $daoName = basename($dao->getFilename(),'.php');

        $mapInterfaceTemplate = new ClassReflection(\Neighborhoods\AreaService\ZFC\Template\MapInterface::class);
        $generator = InterfaceGenerator::fromReflection($mapInterfaceTemplate);

        $fullNamespace = $this->rootNamespace . $this->version . ($parent ? '\\'.$parent:'') . '\\' . $daoName;
        $this->mapInterfaceNamespace = $fullNamespace;

        $generator->setName('MapInterface');
        $generator->setNamespaceName($fullNamespace);
        $generator->addUse($fullNamespace . 'Interface');
        $generator->setExtendedClass('SeekableIterator');

        $methods = $generator->getMethods();
        foreach ($methods as $method) {
            $returnType = $method->getReturnType();
            if ($returnType && strpos($returnType->generate(), 'REPLACE_DAO_NAMEInterface')) {
                $method->setReturnType($fullNamespace.'Interface');
            }
        }

        $file = new FileGenerator();
        $file->setClass($generator);

        $fileContent = $file->generate();
        $builtFile = $this->replaceEntityPlaceholders($fileContent, $daoName);

        $mapDirectory = 'fab/' . $this->version . DIRECTORY_SEPARATOR . ($parent ? $parent.DIRECTORY_SEPARATOR : '')
            . $daoName . DIRECTORY_SEPARATOR;
        if (!is_dir($mapDirectory)) {
            mkdir($mapDirectory,0777,true);
        }

        file_put_contents($mapDirectory . $generator->getName() . '.php', $builtFile);

        return $this;
    }

    protected function generateMapService()
    {
        $yaml = Yaml::parseFile('/var/www/html/area_service.neighborhoods.com/VendorPrefab/src/Map/Service.yml');

        $mapClass = $this->mapNamespace . '\\Map';
        $mapInterface = $this->mapNamespace . '\\MapInterface';

        $yaml['services'][$mapInterface] = $yaml['services']['REPLACE_DAO_MAP_INTERFACE'];
        unset($yaml['services']['REPLACE_DAO_MAP_INTERFACE']);

        $yaml['services'][$mapInterface]['class'] = $mapClass;

        $preparedYaml = Yaml::dump($yaml,3,2);

        file_put_contents($this->mapDirectory.'/Map.yml', $preparedYaml);

        return $this;
    }

    protected function generateRepositoryService(SplFileInfo $dao)
    {
        $parent = $dao->getRelativePath();
        $daoName = basename($dao->getFilename(),'.php');

        $yaml = Yaml::parseFile('/var/www/html/area_service.neighborhoods.com/VendorPrefab/src/Repository/Service.yml');

        $repositoryClass = $this->mapNamespace . '\\Repository';
        $repositoryInterface = $this->mapNamespace . '\\RepositoryInterface';

        $yaml['services'][$repositoryInterface] = $yaml['services']['REPLACE_DAO_REPOSITORY_INTERFACE'];
        unset($yaml['services']['REPLACE_DAO_REPOSITORY_INTERFACE']);

        $yaml['services'][$repositoryInterface]['class'] = $repositoryClass;

        $calls = $yaml['services'][$repositoryInterface]['calls'];
        $replacedCalls = [];

        $versionedDaoName = $this->version.$parent.$daoName;
        $fullDaoName = ($parent) ? $parent."\\\\".$daoName : $daoName;
        foreach ($calls as $call) {
            $json = json_encode($call);
            $json = str_replace('REPLACE_VERSIONED_DAO_NAME', $versionedDaoName,$json);
            $json = str_replace('REPLACE_DAO_VERSION', $this->version,$json);
            $json = str_replace('REPLACE_DAO_NAME', $fullDaoName,$json);
            $call = json_decode($json,true);
            $replacedCalls[] = $call;
        }
        $yaml['services'][$repositoryInterface]['calls'] = $replacedCalls;

        $preparedYaml = Yaml::dump($yaml,4,2);

        file_put_contents($this->mapDirectory.'/Repository.yml', $preparedYaml);

        return $this;
    }

    protected function replaceEntityPlaceholders($fileContent, $entityName)
    {
        $entityItemName = strtolower($entityName);
        $fileContent = str_replace('REPLACE_DAO_NAME', $entityName, $fileContent);
        $fileContent = str_replace('REPLACE_DAO_VAR', $entityItemName, $fileContent);
        $fileContent = str_replace('ZFC\Template', $this->version, $fileContent);
        return $fileContent;
    }
}
