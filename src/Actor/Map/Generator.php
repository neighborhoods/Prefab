<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Map;

use Neighborhoods\Prefab\ClassSaver;
use Neighborhoods\Prefab\CodeGen\ClassGenerator;
use Neighborhoods\Prefab\CodeGen\FileGenerator;
use Neighborhoods\Prefab\Console\GeneratorInterface;
use Neighborhoods\Prefab\Console\GeneratorMetaInterface;
use Symfony\Component\Yaml\Yaml;
use Zend\Code\Generator\DocBlock\Tag;
use Zend\Code\Generator\DocBlockGenerator;
use Zend\Code\Reflection\ClassReflection;
use Neighborhoods\Prefab\StringReplacer;

class Generator implements GeneratorInterface
{
    use ClassSaver\Factory\AwareTrait;
    use StringReplacer\Factory\AwareTrait;

    public const CLASS_NAME = 'Map';

    /** @var ClassGenerator */
    protected $generator;
    /** @var GeneratorMetaInterface */
    protected $meta;

    public function generate(): GeneratorInterface
    {
        $this->setGenerator();

        $meta = $this->getMeta();

        $this->getGenerator()->setName(self::CLASS_NAME);
        $this->getGenerator()->setNamespaceName($meta->getActorNamespace());
        $this->getGenerator()->setExtendedClass('\ArrayIterator');
        $this->getGenerator()->setImplementedInterfaces([$meta->getActorNamespace() . '\MapInterface']);
        $this->getGenerator()->addUse($meta->getActorNamespace() . 'Interface');

        $tag = new Tag\GenericTag();
        $tag->setName('codeCoverageIgnore');

        $classDocBlock = new DocBlockGenerator();
        $classDocBlock->setTag($tag);

        $this->getGenerator()->setDocBlock($classDocBlock);

        $file = new FileGenerator();
        $file->setClass($this->getGenerator());

        $builtFile = $this->replaceEntityPlaceholders($file->generate());

        $this->getClassSaverFactory()->create()
            ->setClassName(self::CLASS_NAME)
            ->setGeneratedClass($builtFile)
            ->setSavePath($this->getMeta()->getActorFilePath())
            ->saveClass();

        $this->generateService();

        return $this;
    }

    protected function replaceEntityPlaceholders(string $fileContent) : string
    {
        $fileContent = str_replace('\Neighborhoods\Prefab\Actor\Map\\', '', $fileContent);

        return $this->getStringReplacerFactory()
            ->create()
            ->setNamespace($this->getMeta()->getActorNamespace())
            ->setFile($fileContent)
            ->replacePlaceholders();

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

    protected function generateService() : GeneratorInterface
    {
        $class = $this->getMeta()->getActorNamespace() . '\\Map';
        $interface = $this->getMeta()->getActorNamespace() . '\\MapInterface';

        $yaml = [
            'services' => [
                $interface => [
                    'class' => $class,
                    'public' => false,
                    'shared' => false,
                ]
            ]
        ];

        $preparedYaml = Yaml::dump($yaml, 4, 2);
        file_put_contents($this->getMeta()->getActorFilePath() . '/' . self::CLASS_NAME . '.yml', $preparedYaml);

        return $this;
    }
}
