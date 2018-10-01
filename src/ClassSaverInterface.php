<?php

namespace Neighborhoods\Prefab;

interface ClassSaverInterface
{
    public function saveClass() : ClassSaverInterface;
    public function setNamespace(string $namespace) : ClassSaverInterface;
    public function setGeneratedClass(string $generatedClass) : ClassSaverInterface;
    public function setClassName(string $className) : ClassSaverInterface;
}
