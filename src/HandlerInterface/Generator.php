<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\HandlerInterface;

use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\InterfaceGenerator;
use Zend\Code\Reflection\ClassReflection;
use Neighborhoods\Prefab\ClassSaver;

class Generator implements GeneratorInterface
{
    use ClassSaver\AwareTrait;

    protected $namespace;
    protected $version;
    protected $generator;
    protected $daoName;
    protected $varName;
    protected $classSaver;
    protected $entityName;

    protected const INTERFACE_NAME = 'HandlerInterface';

    public function generate() : GeneratorInterface
    {
        $this->setGenerator();

        $this->getGenerator()->setNamespaceName($this->getNamespace());
        $this->getGenerator()->setName(self::INTERFACE_NAME);
        $this->getGenerator()->setNamespaceName($this->namespace);
        $this->replaceReturnTypePlaceHolders();

        $file = new FileGenerator();
        $file->setClass($this->getGenerator());

        $builtFile = $this->replaceEntityPlaceholders($file->generate());

        $this->getClassSaver()
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
        $fileContent = str_replace('TRUNCATEDDAONAMEPLACEHOLDER', $this->getEntityName(), $fileContent);
        $fileContent = str_replace('DAONAMEPLACEHOLDER', $this->getNamespace(), $fileContent);
        $methodVarName = implode('', explode('\\', $this->getNamespace()));
        $fileContent = str_replace('DAOVARNAMEPLACEHOLDER', $methodVarName, $fileContent);
        // Because Zend Code just ignores extended interfaces altogether, we need to do this
        // This is temporary (tm) until we can build our own, more robust, code generator
        $fileContent = str_replace(
            'interface HandlerInterface',
            'interface HandlerInterface extends \Psr\Http\Server\RequestHandlerInterface',
            $fileContent
        );
        return $fileContent;
    }


    protected function getEntityName() : string
    {
        if ($this->entityName === null) {
            $namespaceArray = explode('\\', $this->getNamespace()) ;
            $this->entityName = $namespaceArray[count($namespaceArray) - 2];
        }

        return $this->entityName;
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
