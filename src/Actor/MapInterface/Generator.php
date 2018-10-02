<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\MapInterface;

use Neighborhoods\Prefab\ClassSaver;
use Neighborhoods\Prefab\CodeGen\ClassGenerator;
use Neighborhoods\Prefab\CodeGen\FileGenerator;
use Neighborhoods\Prefab\CodeGen\InterfaceGenerator;
use Neighborhoods\Prefab\Console\GeneratorInterface;
use Neighborhoods\Prefab\Console\GeneratorMetaInterface;
use Zend\Code\Reflection\ClassReflection;
use Neighborhoods\Prefab\StringReplacer;

class Generator implements GeneratorInterface
{
    use ClassSaver\Factory\AwareTrait;
    use StringReplacer\Factory\AwareTrait;

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
            ->setClassName(self::CLASS_NAME)
            ->setGeneratedClass($builtFile)
            ->setSavePath($this->getMeta()->getActorFilePath())
            ->saveClass();

        return $this;
    }

    protected function replaceEntityPlaceholders(string $fileContent) : string
    {
        $fileContent = str_replace('\Neighborhoods\Prefab\Actor\MapInterface\\', '', $fileContent);

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

    protected function getGenerator()
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
