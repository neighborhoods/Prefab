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
        $finder->files()->in('/var/www/html/area_service.neighborhoods.com/src/DAO');

        foreach ($finder as $dao) {
            $this->generateMap($dao);
            $this->generateMapInterface($dao);
        }
    }

    public function generateMap(SplFileInfo $dao)
    {
        $parent = $dao->getRelativePath();
        $daoName = basename($dao->getFilename(),'.php');

        $mapTemplate = new ClassReflection(\Neighborhoods\AreaService\ZFC\Template\Map::class);
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

        $mapInterfaceTemplate = new ClassReflection(\Neighborhoods\AreaService\ZFC\Template\MapInterface::class);
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


//    protected function generateConstructorMethod(): MethodGenerator
//    {
//        $pluralDao = strtolower($this->getDaoName()).'s';
//        $constructorMethod = new MethodGenerator();
//        $constructorMethod->setDocBlock(DocBlockGenerator::fromArray([
//            'shortDescription' => null,
//            'longDescription'  => null,
//            'tags'             => [
//                new ParamTag($pluralDao, $this->getDaoName().'Interface', null, true)
//            ],
//        ]));
//        $constructorMethod->setFlags(MethodGenerator::FLAG_PUBLIC);
//        $constructorMethod->setName('__construct');
//        $constructorMethod->setParameter([
//            'name' => $pluralDao,
//            'type' => 'array',
//            'defaultvalue' => []
//        ]);
//        $constructorMethod->setParameter([
//            'name' => 'flags',
//            'type' => 'int',
//            'defaultvalue' => 0
//        ]);
//        $constructorMethod->setBody($this->generateConstructorBody());
//
//        return $constructorMethod;
//    }
//
//    protected function generateConstructorBody()
//    {
//        $pluralDao = strtolower($this->getDaoName()).'s';
//
//        $content = 'if ($this->count() !== 0) {
//    throw new \LogicException(\'Map is not empty.\');
//}
//
//if (!empty($'.$pluralDao.')) {
//    $this->assertValidArrayType(...array_values($'.$pluralDao.'));
//}
//
//parent::__construct($'.$pluralDao.', $flags);
//';
//
//        return $content;
//    }
//
//    protected function generateOffsetGetMethod(): MethodGenerator
//    {
//        $offsetGetMethod = new MethodGenerator();
//        $offsetGetMethod->setFlags(MethodGenerator::FLAG_PUBLIC);
//        $offsetGetMethod->setName('offsetGet');
//        $offsetGetMethod->setParameter(['name' => 'index']);
//        $offsetGetMethod->setBody('return $this->assertValidArrayItemType(parent::offsetGet($index));');
//        $offsetGetMethod->setReturnType($this->getDaoName().'Interface');
//
//        return $offsetGetMethod;
//    }
//
//    protected function generateOffsetSetMethod(): MethodGenerator
//    {
//        $offsetSetMethod = new MethodGenerator();
//        $offsetSetMethod->setFlags(MethodGenerator::FLAG_PUBLIC);
//        $offsetSetMethod->setName('offsetSet');
//        $offsetSetMethod->setDocBlock(DocBlockGenerator::fromArray([
//            'shortDescription' => null,
//            'longDescription'  => null,
//            'tags'             => [
//                new ParamTag(strtolower($this->getDaoName()), $this->getDaoName().'Interface')
//            ],
//        ]));
//        $offsetSetMethod->setParameter(['name' => 'index']);
//        $offsetSetMethod->setParameter(['name' => 'area']);
//        $offsetSetMethod->setBody(
//            'parent::offsetSet($index, $this->assertValidArrayItemType($'.strtolower($this->getDaoName()).'));');
//
//        return $offsetSetMethod;
//    }
//
//    protected function generateAppendMethod(): MethodGenerator
//    {
//        $appendMethod = new MethodGenerator();
//        $appendMethod->setFlags(MethodGenerator::FLAG_PUBLIC);
//        $appendMethod->setName('append');
//        $appendMethod->setDocBlock(DocBlockGenerator::fromArray([
//            'shortDescription' => null,
//            'longDescription'  => null,
//            'tags'             => [
//                new ParamTag(strtolower($this->getDaoName()), $this->getDaoName().'Interface')
//            ],
//        ]));
//        $appendMethod->setParameter(['name' => 'area']);
//        $appendMethod->setBody('$this->assertValidArrayItemType($area);
//parent::append($area);');
//
//        return $appendMethod;
//    }
//
//    protected function generateCurrentMethod(): MethodGenerator
//    {
//        $currentMethod = new MethodGenerator();
//        $currentMethod->setFlags(MethodGenerator::FLAG_PUBLIC);
//        $currentMethod->setName('current');
//        $currentMethod->setBody('return parent::current();');
//        $currentMethod->setReturnType($this->getDaoName().'Interface');
//
//        return $currentMethod;
//    }
//
//    protected function generateAssertValidArrayItemTypeMethod(): MethodGenerator
//    {
//        $assertValidArrayItemTypeMethod = new MethodGenerator();
//        $assertValidArrayItemTypeMethod->setFlags(MethodGenerator::FLAG_PROTECTED);
//        $assertValidArrayItemTypeMethod->setName('assertValidArrayItemType');
//
//        $parameter = new ParameterGenerator();
//        $parameter->setName('area');
//        $parameter->setType($this->getDaoName().'Interface');
//
//        $assertValidArrayItemTypeMethod->setParameter($parameter);
//        $assertValidArrayItemTypeMethod->setBody('return $' . strtolower($this->getDaoName()) . ';');
//
//        return $assertValidArrayItemTypeMethod;
//    }
//
//    protected function generateAssertValidArrayTypeMethod(): MethodGenerator
//    {
//        $assertValidArrayTypeMethod = new MethodGenerator();
//        $assertValidArrayTypeMethod->setFlags(MethodGenerator::FLAG_PROTECTED);
//        $assertValidArrayTypeMethod->setName('assertValidArrayType');
//
//        $parameter = new ParameterGenerator();
//        $parameter->setName(strtolower($this->getDaoName()));
//        $parameter->setType($this->getDaoName().'Interface');
//        $parameter->setVariadic(true);
//
//        $assertValidArrayTypeMethod->setParameter($parameter);
//        $assertValidArrayTypeMethod->setBody('return $this;');
//        $assertValidArrayTypeMethod->setReturnType('MapInterface');
//
//        return $assertValidArrayTypeMethod;
//    }
//
//    protected function generateGetArrayCopyMethod(): MethodGenerator
//    {
//        $getArrayCopyMethod = new MethodGenerator();
//        $getArrayCopyMethod->setFlags(MethodGenerator::FLAG_PUBLIC);
//        $getArrayCopyMethod->setName('getArrayCopy');
//        $getArrayCopyMethod->setBody('return new self(parent::getArrayCopy(), (int)$this->getFlags());');
//        $getArrayCopyMethod->setReturnType('MapInterface');
//
//        return $getArrayCopyMethod;
//    }
//
//    protected function generateToArrayMethod(): MethodGenerator
//    {
//        $getArrayCopyMethod = new MethodGenerator();
//        $getArrayCopyMethod->setFlags(MethodGenerator::FLAG_PUBLIC);
//        $getArrayCopyMethod->setName('toArray');
//        $getArrayCopyMethod->setBody('return (array)$this;');
//        $getArrayCopyMethod->setReturnType('array');
//
//        return $getArrayCopyMethod;
//    }
//
//    protected function generateHydrateMethod(): MethodGenerator
//    {
//        $hydrateMethod = new MethodGenerator();
//        $hydrateMethod->setFlags(MethodGenerator::FLAG_PUBLIC);
//        $hydrateMethod->setName('hydrate');
//
//        $parameter = new ParameterGenerator();
//        $parameter->setName('array');
//        $parameter->setType('array');
//        $hydrateMethod->setParameter($parameter);
//        $hydrateMethod->setBody('$this->__construct($array);
//
//return $this;');
//        $hydrateMethod->setReturnType('MapInterface');
//
//        return $hydrateMethod;
//    }
//
//    protected function fixImplementedInterfaces($fileContent)
//    {
//        $fileContent = str_replace(') : \\', '): ',$fileContent);
//        return $fileContent;
//    }
//
//    protected function fixReturnTypes($fileContent)
//    {
//        $fileContent = str_replace('implements \\', 'implements ',$fileContent);
//        return $fileContent;
//    }
}
