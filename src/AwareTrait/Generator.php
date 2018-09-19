<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AwareTrait;

use Neighborhoods\Prefab\Console\GeneratorMetaInterface;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\TraitGenerator;
use Zend\Code\Reflection\ClassReflection;
use Neighborhoods\Prefab\ClassSaver;
use Neighborhoods\Prefab\Console\GeneratorInterface;

class Generator implements GeneratorInterface
{
    protected $namespace;
    protected $version;
    protected $generator;
    protected $daoName;
    protected $varName;
    protected $classSaver;

    protected const TRAIT_NAME = 'AwareTrait';

    use ClassSaver\AwareTrait;

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

    public function getActorName(): string
    {
        return self::TRAIT_NAME;
    }

    public function generate() : GeneratorInterface
    {
        $this->setVarName(implode('', explode('\\', $this->getNamespace())));
        $this->setGenerator();

        $this->getGenerator()->setNamespaceName($this->getNamespace());
        $this->getGenerator()->setName(self::TRAIT_NAME);

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


    protected function getVarName() : string
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
}
