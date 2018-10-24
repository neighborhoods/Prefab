<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\RepositoryInterface;

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
    protected $projectName;
    protected $classSaver;
    protected $meta;

    protected const INTERFACE_NAME = 'RepositoryInterface';

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
            ->setClassName(self::INTERFACE_NAME)
            ->setGeneratedClass($builtFile)
            ->setSavePath($this->getMeta()->getActorFilePath())
            ->saveClass();

        return $this;
    }

    protected function replaceReturnTypePlaceHolders() : GeneratorInterface
    {
        $methods = $this->getGenerator()->getMethods();

        foreach ($methods as $method) {
            $returnType = $method->getReturnType();
            if ($returnType && strpos($returnType->generate(), 'DAONAMEPLACEHOLDERInterface')) {
                $method->setReturnType($this->getMeta()->getActorNamespace() . 'Interface');
            }
        }

        return $this;
    }

    protected function replaceEntityPlaceholders(string $fileContent) : string
    {
        return $this->getStringReplacerFactory()
            ->create()
            ->setNamespace($this->getMeta()->getActorNamespace())
            ->setFile($fileContent)
            ->replacePlaceholders();
    }

    protected function getVersion() : string
    {
        if ($this->version === null) {
            throw new \LogicException('Generator version has not been set.');
        }
        return $this->version;
    }

    public function setVersion(string $version) : GeneratorInterface
    {
        if ($this->version !== null) {
            throw new \LogicException('Generator version is already set.');
        }
        $this->version = $version;
        return $this;
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

    protected function getProjectName() : string
    {
        if ($this->projectName === null) {
            $this->projectName = explode('\\', $this->getMeta()->getActorNamespace())[1];
        }
        return $this->projectName;
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

    public function getActorName() : string
    {
        return self::INTERFACE_NAME;
    }

}
