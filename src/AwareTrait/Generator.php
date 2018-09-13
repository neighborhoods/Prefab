<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AwareTrait;

use Symfony\Component\Finder\SplFileInfo;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\TraitGenerator;
use Zend\Code\Reflection\ClassReflection;

class Generator implements GeneratorInterface
{
    protected $namespace;
    protected $version;
    protected $projectName;
    protected $generator;
    protected $daoName;
    protected $varName;

    protected const TRAIT_NAME = 'AwareTrait';

    public function generate(SplFileInfo $dao) : GeneratorInterface
    {
        $this->setDaoName(basename($dao->getFilename(), '.php'));
        $this->setVarName(implode('', explode('\\', $this->namespace)));
        $this->setGenerator();

        $this->getGenerator()->setNamespaceName($this->getNamespace());

        $this->getGenerator()->setName(self::TRAIT_NAME);
        $this->getGenerator()->setNamespaceName($this->namespace);
        $this->replaceReturnTypePlaceHolders();

        $file = new FileGenerator();
        $file->setClass($this->getGenerator());

        $builtFile = $this->replaceEntityPlaceholders($file->generate());

        $mapDirectory = 'fab/' . $this->version . DIRECTORY_SEPARATOR . $this->getDaoName() . DIRECTORY_SEPARATOR;

        if (!is_dir($mapDirectory)) {
            mkdir($mapDirectory, 0777, true);
        }

        file_put_contents($mapDirectory . $this->getGenerator()->getName() . '.php', $builtFile);

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
        $fileContent = str_replace('PROJECTNAMEPLACEHOLDER', $this->getProjectName(), $fileContent);

        return $fileContent;
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

    public function getProjectName() : string
    {
        if ($this->projectName === null) {
            throw new \LogicException('Generator projectName has not been set.');
        }
        return $this->projectName;
    }

    public function setProjectName(string $projectName) : GeneratorInterface
    {
        if ($this->projectName !== null) {
            throw new \LogicException('Generator projectName is already set.');
        }
        $this->projectName = $projectName;
        return $this;
    }

    protected function getDaoName() : string
    {
        if ($this->daoName === null) {
            throw new \LogicException('Generator daoName has not been set.');
        }
        return $this->daoName;
    }

    public function setDaoName(string $daoName) : GeneratorInterface
    {
        if ($this->daoName !== null) {
            throw new \LogicException('Generator daoName is already set.');
        }
        $this->daoName = $daoName;
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

}
