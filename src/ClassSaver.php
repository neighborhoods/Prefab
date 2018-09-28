<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

class ClassSaver implements ClassSaverInterface
{
    protected $namespace;
    protected $generatedClass;
    protected $className;

    public function saveClass() : ClassSaverInterface
    {
        file_put_contents($this->getFileLocation() . $this->getClassName() . '.php', $this->getGeneratedClass());
        return $this;
    }

    protected function getNamespace() : string
    {
        if ($this->namespace === null) {
            throw new \LogicException('ClassSaver namespace has not been set.');
        }
        return $this->namespace;
    }

    public function setNamespace(string $namespace) : ClassSaverInterface
    {
        if ($this->namespace !== null) {
            throw new \LogicException('ClassSaver namespace is already set.');
        }
        $this->namespace = $namespace;
        return $this;
    }

    protected function getGeneratedClass() : string
    {
        if ($this->generatedClass === null) {
            throw new \LogicException('ClassSaver generatedClass has not been set.');
        }
        return $this->generatedClass;
    }

    public function setGeneratedClass(string $generatedClass) : ClassSaverInterface
    {
        if ($this->generatedClass !== null) {
            throw new \LogicException('ClassSaver generatedClass is already set.');
        }
        $this->generatedClass = $generatedClass;
        return $this;
    }

    protected function getFileLocation() : string
    {
        $namespaceArray = explode('\\', $this->getNamespace());
        $namespaceArray = array_slice($namespaceArray, 2);

        $directory = 'fab/' . implode('/', $namespaceArray) . '/';

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        return $directory;
    }

    protected function getClassName() : string
    {
        if ($this->className === null) {
            throw new \LogicException('ClassSaver className has not been set.');
        }
        return $this->className;
    }

    public function setClassName(string $className) : ClassSaverInterface
    {
        if ($this->className !== null) {
            throw new \LogicException('ClassSaver className is already set.');
        }
        $this->className = $className;
        return $this;
    }
}
