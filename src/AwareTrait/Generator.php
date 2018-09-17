<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AwareTrait;

use Neighborhoods\Prefab\ClassSaverInterface;
use Symfony\Component\Finder\SplFileInfo;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\TraitGenerator;
use Zend\Code\Reflection\ClassReflection;

class Generator implements GeneratorInterface
{
    protected $namespace;
    protected $version;
    protected $generator;
    protected $daoName;
    protected $varName;
    protected $classSaver;

    protected const TRAIT_NAME = 'AwareTrait';

    public function generate(SplFileInfo $dao) : GeneratorInterface
    {
        $this->setVarName(implode('', explode('\\', $this->namespace)));
        $this->setGenerator();

        $this->getGenerator()->setNamespaceName($this->getNamespace());

        $this->getGenerator()->setName(self::TRAIT_NAME);
        $this->getGenerator()->setNamespaceName($this->namespace);
        $this->replaceReturnTypePlaceHolders();

        $file = new FileGenerator();
        $file->setClass($this->getGenerator());

        $builtFile = $this->replaceEntityPlaceholders($file->generate());

        $this->getClassSaver()
            ->setNamespace($this->getNamespace())
            ->setClassName(self::TRAIT_NAME)
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
        $fileContent = str_replace('VARNAMEPLACEHOLDER', $this->getVarName(), $fileContent);

        return $fileContent;
    }

    protected function setGenerator() : GeneratorInterface
    {
        $template = new ClassReflection(Template::class);
        $this->generator = TraitGenerator::fromReflection($template);
        return $this;
    }

    protected function getGenerator() : TraitGenerator
    {
        if ($this->generator === null) {
            throw new \LogicException('Generator generator has not been set');
        }

        return $this->generator;
    }

    public function getNamespace() : string
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


    public function getVarName() : string
    {
        if ($this->varName === null) {
            throw new \LogicException('Generator varName has not been set.');
        }
        return $this->varName;
    }

    public function setVarName(string $varName) : GeneratorInterface
    {
        if ($this->varName !== null) {
            throw new \LogicException('Generator varName is already set.');
        }
        $this->varName = $varName;
        return $this;
    }

    public function getClassSaver() : ClassSaverInterface
    {
        if ($this->classSaver === null) {
            throw new \LogicException('Generator classSaver has not been set.');
        }
        return $this->classSaver;
    }

    public function setClassSaver(ClassSaverInterface $classSaver) : GeneratorInterface
    {
        if ($this->classSaver !== null) {
            throw new \LogicException('Generator classSaver is already set.');
        }
        $this->classSaver = $classSaver;
        return $this;
    }
}
