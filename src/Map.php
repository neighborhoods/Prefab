<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\InterfaceGenerator;
use Zend\Code\Reflection\ClassReflection;

class Map
{
    protected $rootNamespace = 'Neighborhoods\AreaService\\';
    protected $version;

    public function __construct()
    {
        $this->version = 'MV2';

        $finder = new Finder();
        $finder->files()->in('/var/www/html/prefab_examples.neighborhoods.com/JakeService/src');

        foreach ($finder as $dao) {
            $this->generateMap($dao);
//            $this->generateMapInterface($dao);
        }
    }

    public function generateMap(SplFileInfo $dao)
    {
        $parent = $dao->getRelativePath();
        $daoName = basename($dao->getFilename(),'.php');

        $mapTemplate = new ClassReflection(\Neighborhoods\Prefab\Map\Template::class);
        $generator = ClassGenerator::fromReflection($mapTemplate);

        $fullNamespace = $this->rootNamespace . $this->version . ($parent ? '\\'.$parent:'') . '\\' . $daoName;

        $generator->setName('Map');
        $generator->setNamespaceName($fullNamespace);
        $generator->setExtendedClass('\ArrayIterator');
        $generator->setImplementedInterfaces([$fullNamespace . '\MapInterface']);
        $generator->addUse($fullNamespace . 'Interface');

        $methods = $generator->getMethods();
        foreach ($methods as $method) {
            $returnType = $method->getReturnType();
            if ($returnType && strpos($returnType->generate(), 'RPL_ENTITY_NAMEInterface')) {
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

    protected function generateMapInterface(SplFileInfo $dao)
    {
        $parent = $dao->getRelativePath();
        $daoName = basename($dao->getFilename(),'.php');

        $mapInterfaceTemplate = new ClassReflection(\Neighborhoods\Prefab\MapInterface\Template::class);
        $generator = InterfaceGenerator::fromReflection($mapInterfaceTemplate);

        $fullNamespace = $this->rootNamespace . $this->version . ($parent ? '\\'.$parent:'') . '\\' . $daoName;

        $generator->setName('MapInterface');
        $generator->setNamespaceName($fullNamespace);
        $generator->addUse($fullNamespace . 'Interface');

        $methods = $generator->getMethods();
        foreach ($methods as $method) {
            $returnType = $method->getReturnType();
            if ($returnType && strpos($returnType->generate(), 'RPL_ENTITY_NAMEInterface')) {
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

    protected function replaceEntityPlaceholders($fileContent, $entityName)
    {
        $entityItemName = strtolower($entityName);
        $fileContent = str_replace('RPL_ENTITY_NAME', $entityName, $fileContent);
        $fileContent = str_replace('RPL_ENTITY_ITEM', $entityItemName, $fileContent);
        $fileContent = str_replace('ZFC\Template', $this->version, $fileContent);
        return $fileContent;
    }
}
