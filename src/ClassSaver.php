<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

class ClassSaver implements ClassSaverInterface
{
    protected $namespace;
    protected $generatedClass;
    protected $className;
    protected $savePath;

    public function saveClass() : ClassSaverInterface
    {
        if (!file_exists($this->getSavePath())) {
            mkdir($this->getSavePath(), 0777, true);
        }

        file_put_contents($this->getSavePath() . '/' . $this->getClassName() . '.php', $this->getGeneratedClass());
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

    public function getSavePath() : string
    {
        if ($this->savePath === null) {
            throw new \LogicException('ClassSaver savePath has not been set.');
        }
        return $this->savePath;
    }

    public function setSavePath(string $savePath) : ClassSaverInterface
    {
        if ($this->savePath !== null) {
            throw new \LogicException('ClassSaver savePath is already set.');
        }
        $this->savePath = $savePath;
        return $this;
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
