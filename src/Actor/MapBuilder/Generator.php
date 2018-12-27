<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\MapBuilder;

use Neighborhoods\Prefab\ClassSaver\Factory\AwareTrait;
use Neighborhoods\Prefab\Console\GeneratorInterface;
use Neighborhoods\Prefab\Console\GeneratorMetaInterface;
use Symfony\Component\Yaml\Yaml;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Reflection\ClassReflection;
use Neighborhoods\Prefab\StringReplacer;

class Generator implements GeneratorInterface
{
    use AwareTrait;
    use StringReplacer\Factory\AwareTrait;

    public const CLASS_NAME = 'Builder';

    protected $generator;
    protected $varName;
    protected $projectName;
    protected $classSaver;
    /** @var GeneratorMetaInterface */
    protected $meta;

    public function generate() : GeneratorInterface
    {
        $this->setGenerator();

        $this->getGenerator()->setNamespaceName($this->getMeta()->getActorNamespace());
        $this->getGenerator()->setImplementedInterfaces([$this->getMeta()->getActorNamespace() . '\BuilderInterface']);
        $this->getGenerator()->setName(self::CLASS_NAME);

        $this->getGenerator()->addTraits(
            [
                '\\' . $this->getMeta()->getActorNamespace() . '\Factory\AwareTrait',
                '\\PARENTNAMESPACEPLACEHOLDER\Builder\Factory\AwareTrait',
            ]
        );

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

    protected function generateService() : GeneratorInterface
    {
        $class = $this->getMeta()->getActorNamespace() . '\\Builder';
        $interface = $this->getMeta()->getActorNamespace() . '\\BuilderInterface';

        $methodPrefix = $this->getTruncatedParentNamespace();

        $yaml = [
            'services' => [
                $interface => [
                    'class' => $class,
                    'public' => false,
                    'shared' => false,
                    'calls' => [
                        [ "set{$methodPrefix}MapFactory", ["@{$this->getMeta()->getActorNamespace()}\\FactoryInterface"]],
                        [ "set{$methodPrefix}BuilderFactory", ["@{$this->getParentNamespace()}\\Builder\\FactoryInterface"]],
                    ]
                ]
            ]
        ];

        $preparedYaml = Yaml::dump($yaml, 4, 2);
        file_put_contents(
            $this->getMeta()->getActorFilePath() . '/' . self::CLASS_NAME . '.service.yml',
            $preparedYaml
        );

        return $this;
    }

    protected function getTruncatedNamespace() : string
    {
        $namespaceArray = explode('\\', $this->getMeta()->getActorNamespace());
        unset($namespaceArray[0]);
        unset($namespaceArray[1]);
        return implode('', $namespaceArray);
    }

    protected function getTruncatedParentNamespace() : string
    {
        $namespaceArray = explode('\\', $this->getMeta()->getActorNamespace());
        unset($namespaceArray[count($namespaceArray) - 1]);
        unset($namespaceArray[0]);
        unset($namespaceArray[1]);
        return implode('', $namespaceArray);
    }

    protected function getParentNamespace() : string
    {
        $namespaceArray = explode('\\', $this->getMeta()->getActorNamespace());
        unset($namespaceArray[count($namespaceArray) - 1]);
        return implode('\\', $namespaceArray);
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

    public function getProjectName() : string
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
        return self::CLASS_NAME;
    }
}
