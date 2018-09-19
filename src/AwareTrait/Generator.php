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
    use ClassSaver\Factory\AwareTrait;

    protected const TRAIT_NAME = 'AwareTrait';

    /** @var GeneratorMetaInterface */
    protected $meta;
    protected $generator;
    protected $varName;

    public function generate() : GeneratorInterface
    {
        $this->setVarName(implode('', explode('\\', $this->getMeta()->getActorNamespace())));
        $this->setGenerator();

        $this->getGenerator()->setNamespaceName($this->getMeta()->getActorNamespace());
        $this->getGenerator()->setName(self::TRAIT_NAME);

        $this->replaceReturnTypePlaceHolders();

        $file = new FileGenerator();
        $file->setClass($this->getGenerator());

        $builtFile = $this->replaceEntityPlaceholders($file->generate());

        $this->getClassSaverFactory()->create()
            ->setNamespace($this->getMeta()->getActorNamespace())
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
                $method->setReturnType($this->getMeta()->getActorNamespace() . 'Interface');
            }
        }
    }

    protected function replaceEntityPlaceholders($fileContent) : string
    {
        $fileContent = str_replace('DAONAMEPLACEHOLDER', $this->getMeta()->getActorNamespace(), $fileContent);
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
}
