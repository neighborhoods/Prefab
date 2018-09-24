<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\MapInterface;

use Neighborhoods\Prefab\ClassSaver;
use Neighborhoods\Prefab\Console\GeneratorInterface;
use Neighborhoods\Prefab\Console\GeneratorMetaInterface;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\InterfaceGenerator;
use Zend\Code\Reflection\ClassReflection;

class Generator implements GeneratorInterface
{
    use ClassSaver\Factory\AwareTrait;

    public const CLASS_NAME = 'MapInterface';

    /** @var ClassGenerator */
    protected $generator;
    /** @var GeneratorMetaInterface */
    protected $meta;

    public function generate(): GeneratorInterface
    {
        $this->setGenerator();

        $meta = $this->getMeta();

        $this->getGenerator()->setName('MapInterface');
        $this->getGenerator()->setNamespaceName($meta->getActorNamespace());
        $this->getGenerator()->addUse($meta->getActorNamespace() . 'Interface');
        $this->getGenerator()->setExtendedClass('\SeekableIterator, \ArrayAccess, \Serializable, \Countable');

        $file = new FileGenerator();
        $file->setClass($this->getGenerator());

        $builtFile = $this->replaceEntityPlaceholders($file->generate());

        $this->getClassSaverFactory()->create()
            ->setNamespace($this->getMeta()->getActorNamespace())
            ->setClassName(self::CLASS_NAME)
            ->setGeneratedClass($builtFile)
            ->saveClass();

        return $this;
    }

    protected function replaceEntityPlaceholders($fileContent)
    {
        $entityName = $this->getMeta()->getDaoName();
        $entityItemName = strtolower($entityName);
        $fileContent = str_replace('REPLACE_DAO_NAME', $entityName, $fileContent);
        $fileContent = str_replace('REPLACE_DAO_VAR', $entityItemName, $fileContent);
        $fileContent = str_replace('\Neighborhoods\Prefab\MapInterface\\', '', $fileContent);
        $fileContent = substr_replace($fileContent, "declare(strict_types=1);\n", 6, 0);
        return $fileContent;
    }

    protected function setGenerator() : GeneratorInterface
    {
        $template = new ClassReflection(Template::class);
        $this->generator = InterfaceGenerator::fromReflection($template);
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
