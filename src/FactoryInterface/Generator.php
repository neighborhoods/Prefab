<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FactoryInterface;

use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\InterfaceGenerator;
use Zend\Code\Reflection\ClassReflection;
use Neighborhoods\Prefab\ClassSaver;

class Generator implements GeneratorInterface
{
    use ClassSaver\Factory\AwareTrait;

    protected $namespace;
    protected $version;
    protected $generator;
    protected $daoName;
    protected $varName;
    protected $classSaver;

    protected const INTERFACE_NAME = 'FactoryInterface';

    public function generate() : GeneratorInterface
    {
        $this->setGenerator();

        $this->getGenerator()->setNamespaceName($this->getNamespace());
        $this->getGenerator()->setName(self::INTERFACE_NAME);

        $this->replaceReturnTypePlaceHolders();

        $file = new FileGenerator();
        $file->setClass($this->getGenerator());

        $builtFile = $this->replaceEntityPlaceholders($file->generate());

        $this->getClassSaverFactory()->create()
            ->setNamespace($this->getNamespace())
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
                $method->setReturnType($this->getNamespace() . 'Interface');
            }
        }
    }

    protected function replaceEntityPlaceholders($fileContent) : string
    {
        $fileContent = str_replace('DAONAMEPLACEHOLDER', $this->getNamespace(), $fileContent);
        $methodVarName = implode('', explode('\\', $this->getNamespace()));
        $fileContent = str_replace('DAOVARNAMEPLACEHOLDER', $methodVarName, $fileContent);
        return $fileContent;
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
}
