<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Factory;

use Neighborhoods\Prefab\ClassSaverInterface;
use Neighborhoods\Prefab\Console\GeneratorInterface;
use Neighborhoods\Prefab\Console\GeneratorMetaInterface;
use Symfony\Component\Yaml\Yaml;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Reflection\ClassReflection;
use Neighborhoods\Prefab\ClassSaver;
use Neighborhoods\Prefab\StringReplacer;

class Generator implements GeneratorInterface
{
    use ClassSaver\Factory\AwareTrait;
    use StringReplacer\Factory\AwareTrait;

    public const CLASS_NAME = 'Factory';

    /** @var ClassGenerator */
    protected $generator;
    /** @var ClassSaverInterface */
    protected $classSaver;
    /** @var GeneratorMetaInterface */
    protected $meta;

    public function generate() : GeneratorInterface
    {
        $this->setGenerator();

        $this->getGenerator()->setNamespaceName($this->getMeta()->getActorNamespace());
        $this->getGenerator()->addTrait('AwareTrait');
        $this->getGenerator()->setImplementedInterfaces([$this->getMeta()->getActorNamespace() . '\FactoryInterface']);
        $this->getGenerator()->setName(self::CLASS_NAME);

        $this->replaceReturnTypePlaceHolders();

        $file = new FileGenerator();
        $file->setClass($this->getGenerator());

        $builtFile = $this->replaceEntityPlaceholders($file->generate());

        $this->getClassSaverFactory()->create()
            ->setNamespace($this->getMeta()->getActorNamespace())
            ->setClassName(self::CLASS_NAME)
            ->setGeneratedClass($builtFile)
            ->saveClass();

        $this->generateService();

        return $this;
    }

    protected function generateService()
    {
        $class = $this->getMeta()->getActorNamespace() . '\\Factory';
        $interface = $this->getMeta()->getActorNamespace() . '\\FactoryInterface';

        $factoryPrefix = $this->getTruncatedNamespace();

        $yaml = [
            'services' => [
                $interface => [
                    'class' => $class,
                    'public' => false,
                    'shared' => true,
                    'calls' => [
                        [ "set{$factoryPrefix}", ["@{$this->getMeta()->getActorNamespace()}Interface" ]]
                    ]
                ]
            ]
        ];

        $preparedYaml = Yaml::dump($yaml, 4, 2);
        file_put_contents($this->getMeta()->getActorFilePath() . '/' . self::CLASS_NAME . '.yml', $preparedYaml);

        return $this;
    }

    protected function getTruncatedNamespace() : string
    {
        $namespaceArray = explode('\\', $this->getMeta()->getActorNamespace());
        unset($namespaceArray[0]);
        unset($namespaceArray[1]);
        return implode('', $namespaceArray);
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
}
