<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\MapInterface;

use Neighborhoods\Prefab\ClassSaver;
use Neighborhoods\Prefab\Console\GeneratorInterface;
use Neighborhoods\Prefab\Console\GeneratorMetaInterface;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Reflection\ClassReflection;

class Generator implements GeneratorInterface
{
    use ClassSaver\AwareTrait;

    public const CLASS_NAME = 'MapInterface';

    /** @var ClassGenerator */
    protected $generator;
    /** @var GeneratorMetaInterface */
    protected $meta;

    public function generate(): GeneratorInterface
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

    protected function replaceReturnTypePlaceHolders()
    {
        $meta = $this->getMeta();
        $methods = $this->getGenerator()->getMethods();

        foreach ($methods as $method) {
            $returnType = $method->getReturnType();
            if ($returnType && strpos($returnType->generate(), 'REPLACE_DAO_NAMEInterface')) {
                $method->setReturnType($meta->getActorNamespace() . '\\' . $meta->getDaoName() . 'Interface');
            }
        }

        return $this;
    }

    protected function replaceEntityPlaceholders($fileContent)
    {
        $entityName = $this->getMeta()->getDaoName();
        $entityItemName = strtolower($entityName);
        $fileContent = str_replace('REPLACE_DAO_NAME', $entityName, $fileContent);
        $fileContent = str_replace('REPLACE_DAO_VAR', $entityItemName, $fileContent);
        return $fileContent;
    }

    protected function setGenerator() : GeneratorInterface
    {
        $template = new ClassReflection(Template::class);
        $this->generator = ClassGenerator::fromReflection($template);
        return $this;
    }

    protected function getGenerator() : ClassGenerator
    {
        if ($this->generator === null) {
            throw new \LogicException('Generator generator has not been set');
        }

        return $this->generator;
    }

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

    public function getActorName(): string
    {
        return self::CLASS_NAME;
    }
}
