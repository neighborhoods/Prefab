<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\FactoryInterface;

use Neighborhoods\Prefab\Console\GeneratorInterface;
use Neighborhoods\Prefab\Console\GeneratorMetaInterface;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\InterfaceGenerator;
use Zend\Code\Reflection\ClassReflection;
use Neighborhoods\Prefab\ClassSaver;
use Neighborhoods\Prefab\StringReplacer;

class Generator implements GeneratorInterface
{
    use ClassSaver\Factory\AwareTrait;
    use StringReplacer\Factory\AwareTrait;

    protected $namespace;
    protected $version;
    protected $generator;
    protected $daoName;
    protected $varName;
    protected $classSaver;
    protected $meta;

    protected const INTERFACE_NAME = 'FactoryInterface';

    public function generate() : GeneratorInterface
    {
        $this->setGenerator();

        $this->getGenerator()->setNamespaceName($this->getMeta()->getActorNamespace());
        $this->getGenerator()->setName(self::INTERFACE_NAME);

        $this->replaceReturnTypePlaceHolders();

        $file = new FileGenerator();
        $file->setClass($this->getGenerator());

        $builtFile = $this->replaceEntityPlaceholders($file->generate());

        $this->getClassSaverFactory()->create()
            ->setNamespace($this->getMeta()->getActorNamespace())
            ->setClassName(self::INTERFACE_NAME)
            ->setGeneratedClass($builtFile)
            ->saveClass();

        return $this;
    }

    protected function replaceReturnTypePlaceHolders()
    {
        $methods = $this->getGenerator()->getMethods();

        foreach ($methods as $method) {
            $returnType = $method->getReturnType();
            if ($returnType && strpos($returnType->generate(), 'DAONAMEPLACEHOLDERInterface')) {
                $method->setReturnType($this->getMeta()->getActorNamespace() . 'Interface');
            }
        }
    }

    protected function replaceEntityPlaceholders($fileContent) : string
    {
        return $this->getStringReplacerFactory()
            ->create()
            ->setNamespace($this->getMeta()->getActorNamespace())
            ->setFile($fileContent)
            ->replacePlaceholders();
    }

    protected function setGenerator() : GeneratorInterface
    {
        $template = new ClassReflection(Template::class);
        $this->generator = InterfaceGenerator::fromReflection($template);
        return $this;
    }

    protected function getGenerator() : InterfaceGenerator
    {
        if ($this->generator === null) {
            throw new \LogicException('Generator generator has not been set');
        }

        return $this->generator;
    }

    protected function getNamespace() : string
    {
        if ($this->namespace === null) {
            throw new \LogicException('Generator namespace has not been set.');
        }
        return $this->namespace;
    }

    public function setNamespace(string $namespace) : GeneratorInterface
    {
        if ($this->namespace !== null) {
            throw new \LogicException('Generator namespace is already set.');
        }
        $this->namespace = $namespace;
        return $this;
    }

    public function getMeta() : GeneratorMetaInterface
    {
        if ($this->meta === null) {
            throw new \LogicException('Generator meta has not been set.');
        }
        return $this->meta;
    }

    public function setMeta(GeneratorMetaInterface $meta) : GeneratorInterface
    {
        if ($this->meta !== null) {
            throw new \LogicException('Generator meta is already set.');
        }
        $this->meta = $meta;
        return $this;
    }

    public function getActorName(): string
    {
        return self::INTERFACE_NAME;
    }
}
